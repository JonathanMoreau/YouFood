<?php

namespace YouFood\RoomBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use YouFood\AdminBundle\Entity\Board;
use YouFood\RoomBundle\Form\BoardChoiceType;

use YouFood\AdminBundle\Entity\YouOrder;
use YouFood\AdminBundle\Entity\YouOrderFood;


class DefaultController extends Controller
{
    
    public function indexAction()
    {

        $entity = new Board();
        $request = $this->getRequest();
        $form  = $this->createForm(new BoardChoiceType(), $entity);
        
        if ($this->getRequest()->getMethod() == 'POST')
        {
            $form->bindRequest($request);

            if ($form->isValid()) {

                $em = $this->getDoctrine()->getEntityManager();

                $board = $em->getRepository('YouFoodAdminBundle:Board')->findOneByNumber($entity->getNumber());

                if (!$board) {
                    throw $this->createNotFoundException('La table que vous avez indiqué n\'existe pas. Pourriez-vous recommencer ?');
                }

                return $this->redirect($this->generateUrl('YouFoodRoomBundle_ready', array('number' => $entity->getNumber())));   
            }
        }

        return $this->render('YouFoodRoomBundle:Default:index.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    public function readyAction($number)
    {

        $em = $this->getDoctrine()->getEntityManager();
        $board = $em->getRepository('YouFoodAdminBundle:Board')->findOneByNumber($number);

        if (!$board) {
            throw $this->createNotFoundException('La table que vous avez indiqué n\'existe pas. Pourriez-vous recommencer ?');
        }

        $menus = $em->getRepository('YouFoodAdminBundle:Menu')->findAll();

        return $this->render('YouFoodRoomBundle:Default:ready.html.twig',
            array('number' => $number,
                  'menus'  => $menus
            ));
    }

    public function panierAction($number)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $session = $this->getRequest()->getSession();

        $foodsIdAndQuantity = $session->get('foods');

        $menusIdAndQuantity = $session->get('menus');

        $foodsOrdered = array();

        $menusOrdered = array();

        $amount = 0;

        if(isset($foodsIdAndQuantity))
        {
            foreach($foodsIdAndQuantity as $i => $foodIdAndQuantity)
            {
                $foodsOrdered[$i]['food'] = $em->getRepository('YouFoodAdminBundle:Food')->findOneById($foodIdAndQuantity['food_id']);
                $foodsOrdered[$i]['quantity'] = $foodIdAndQuantity['quantity'];
            }
        }

        if(isset($menusIdAndQuantity))
        {
            foreach($menusIdAndQuantity as $i => $menuIdAndQuantity)
            {
                $menusOrdered[$i]['menu'] = $em->getRepository('YouFoodAdminBundle:Menu')->findOneById($menuIdAndQuantity['menu_id']);
                $menusOrdered[$i]['quantity'] = $menuIdAndQuantity['quantity'];
                $amount += ($menusOrdered[$i]['quantity'] * $menusOrdered[$i]['menu']->getPrice());
            }
        }

        return $this->render('YouFoodRoomBundle:Default:panier.html.twig',
            array('number' => $number,
                  'foodsOrdered' => $foodsOrdered, 'menusOrdered' => $menusOrdered, 'amount' => $amount
            ));
    }

    public function addMenuAction($number, $menu_id)
    {   
        $request = $this->getRequest();
        $session = $request->getSession();

        $menus = $session->get('menus');

        $found = false;

        if(count($menus) > 0) {
            foreach ($menus as $i => $menu) {
                
                if($menu['menu_id'] == $menu_id) {
                    
                    $menus[$i]['quantity'] =  (int) $menu['quantity'] + 1;
                    $found = true;
                }
            }

            if(!$found) {
                array_push($menus, array('menu_id' => $menu_id, 'quantity' => '1'));
            }
        }
        else {
            $menus = array(array('menu_id' => $menu_id, 'quantity' => '1'));
        }

        $session->set('menus', $menus);

        $this->get('session')->setFlash('addtocart',"Menu commandé !");
        $this->get('session')->setFlash('addtocart-msg',"Le menu que vous avez choisi a été ajouté à votre panier...");
        
        return $this->redirect($request->server->get('HTTP_REFERER'));
    }

    public function addFoodAction($number, $food_id)
    {
        $request = $this->getRequest();
        $session = $request->getSession();

        $foods = $session->get('foods');

        $found = false;

        if(count($foods) > 0) {
            foreach ($foods as $i => $food) {
                
                if($food['food_id'] == $food_id) {
                    
                    $foods[$i]['quantity'] =  (int) $food['quantity'] + 1;
                    $found = true;
                }
            }

            if(!$found) {
                array_push($foods, array('food_id' => $food_id, 'quantity' => '1'));
            }
        }
        else {
            $foods = array(array('food_id' => $food_id, 'quantity' => '1'));
        }

        $session->set('foods', $foods);

        $this->get('session')->setFlash('addtocart',"Plat commandé !");
        $this->get('session')->setFlash('addtocart-msg',"Le plat que vous avez choisi a été ajouté à votre panier...");
        
        return $this->redirect($request->server->get('HTTP_REFERER'));
    }

    public function removeFoodAction($number, $food_id)
    {
        $request = $this->getRequest();
        $session = $request->getSession();

        $foods = $session->get('foods');

        if(count($foods) > 0)
        {
            foreach ($foods as $i => $food) {
                
                if($food['food_id'] == $food_id)
                {
                    
                    $foods[$i]['quantity'] =  (int) $food['quantity'] - 1;
                }
            }
        }

        $session->set('foods', $foods);

        $this->get('session')->setFlash('removetocart',"Plat supprimé !");
        $this->get('session')->setFlash('removetocart-msg',"Le plat que vous avez choisi a été supprimé de votre panier...");
        
        return $this->redirect($request->server->get('HTTP_REFERER'));
    }

    public function removeFoodTotalyAction($number, $food_id)
    {
        $request = $this->getRequest();
        $session = $request->getSession();

        $foods = $session->get('foods');

        if(count($foods) > 0)
        {
            foreach ($foods as $i => $food) {
                
                if($food['food_id'] == $food_id)
                {
                    unset($foods[$i]);
                }
            }
        }

        $session->set('foods', $foods);

        $this->get('session')->setFlash('removetocart',"Plat supprimé !");
        $this->get('session')->setFlash('removetocart-msg',"Le plat que vous avez choisi a été supprimé de votre panier...");
        
        return $this->redirect($request->server->get('HTTP_REFERER'));
    }

    public function removeMenuAction($number, $menu_id)
    {
        $request = $this->getRequest();
        $session = $request->getSession();

        $menus = $session->get('menus');

        if(count($menus) > 0)
        {
            foreach ($menus as $i => $menu) {
                
                if($menu['menu_id'] == $menu_id)
                {
                    
                    $menus[$i]['quantity'] =  (int) $menu['quantity'] - 1;
                }
            }
        }

        $session->set('menus', $menus);

        $this->get('session')->setFlash('removetocart',"Menu supprimé !");
        $this->get('session')->setFlash('removetocart-msg',"Le menu que vous avez choisi a été supprimé de votre panier...");
        
        return $this->redirect($request->server->get('HTTP_REFERER'));
    }

    public function cancelAction($number)
    {
        $request = $this->getRequest();
        $session = $request->getSession();

        $session->set('menus', null);
        $session->set('foods', null);
        
        return $this->redirect($request->server->get('HTTP_REFERER'));
    }

    public function helpAction($number)
    {
        $request = $this->getRequest();

        $em = $this->getDoctrine()->getEntityManager();
        $board = $em->getRepository('YouFoodAdminBundle:Board')->findOneByNumber($number);

        $pusher = $this->container->get('lopi_pusher.pusher');
        $pusher->trigger('youfood_service', 'help', $board->getZone()->getUser()->getName().'. La table '.$number.' requière votre assistance.');

        $this->get('session')->setFlash('help',"Demande envoyée");
        $this->get('session')->setFlash('help-msg',"Une demande d'aide a été envoyée au serveur qui s'occupe de vous. Il ne devrait plus tarder à arriver.");

        return $this->redirect($request->server->get('HTTP_REFERER'));
    }

    public function validateAction($number)
    {
        $request = $this->getRequest();
        $session = $this->getRequest()->getSession();
        $em = $this->getDoctrine()->getEntityManager();

        $menus = $session->get('menus');
        $foods = $session->get('foods');
        $amount = 0;
        $commande = array();

        $youOrder = new YouOrder();
        $youOrder->setPayement(1);
        $youOrder->setStatus(1);

        foreach($menus as $menu)
        {
            $men = $em->getRepository('YouFoodAdminBundle:Menu')->findOneById($menu['menu_id']);
            $amount += ($menu['quantity'] * $men->getPrice());
        }

        $youOrder->setAmount($amount);
        $em->persist($youOrder);
        $em->flush();

        $commande['order']['id'] = $youOrder->getId();
        $commande['order']['board'] = $number;

        foreach ($foods as $i => $food) {
            $youOrderFood  = new YouOrderFood();
            $foo = $em->getRepository('YouFoodAdminBundle:Food')->findOneById($food['food_id']);
            $youOrderFood->setYouOrder($youOrder);
            $youOrderFood->setFood($foo);
            $youOrderFood->setQuantity($food['quantity']);
            $em->persist($youOrderFood);
            $em->flush();

            $commande['foods'][$i]['name'] = $foo->getName();
            $commande['foods'][$i]['quantity'] = $food['quantity'];
            $commande['foods'][$i]['category'] = $foo->getCategory()->getId();
        }

        $session->set('menus', null);
        $session->set('foods', null);

        $pusher = $this->container->get('lopi_pusher.pusher');
        $pusher->trigger('youfood_cook', 'new_order', $commande);

        $this->get('session')->setFlash('validate',"Commande validée");
        $this->get('session')->setFlash('validate-msg',"Votre commande a été validée. En cuisine, ils s'occupent déjà de vous...");

        return $this->redirect($this->generateUrl('YouFoodRoomBundle_homepage'));
    }
}
