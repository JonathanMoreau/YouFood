<?php

namespace YouFood\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use YouFood\AdminBundle\Entity\YouOrder;
use YouFood\AdminBundle\Entity\YouOrderFood;

/**
 * Order controller.
 *
 */
class YouOrderController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('YouFoodAdminBundle:YouOrder')->findAll();

        return $this->render('YouFoodAdminBundle:YouOrder:index.html.twig', array(
            'entities' => $entities
        ));
    }

    public function newAction()
    {
    	$em = $this->getDoctrine()->getEntityManager();
        $menus = $em->getRepository('YouFoodAdminBundle:Menu')->findAll();

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

        return $this->render('YouFoodAdminBundle:YouOrder:new.html.twig', array(
            'menus' => $menus, 'foodsOrdered' => $foodsOrdered, 'menusOrdered' => $menusOrdered, 'amount' => $amount
        ));
    }

    public function createAction()
    {
    	return $this->render('YouFoodAdminBundle:YouOrder:create.html.twig');
    }

    public function addFoodAction($food_id)
    {
        $session = $this->getRequest()->getSession();
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
        
        return $this->redirect($this->generateUrl('YouOrder_new'));
    }

    public function addMenuAction($menu_id)
    {
        $session = $this->getRequest()->getSession();
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
        
        return $this->redirect($this->generateUrl('YouOrder_new'));
    }

    public function removeFoodAction($food_id)
    {
        //supprimer de la session le plat
        $session = $this->getRequest()->getSession();

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
        
        return $this->redirect($this->generateUrl('YouOrder_new'));
    }

    public function removeFoodTotalyAction($food_id)
    {
        $session = $this->getRequest()->getSession();

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
        
        return $this->redirect($this->generateUrl('YouOrder_new'));
    }

    public function removeMenuAction($menu_id)
    {
        $session = $this->getRequest()->getSession();

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
        
        return $this->redirect($this->generateUrl('YouOrder_new'));
    }

    public function cancelAction()
    {
        $session = $this->getRequest()->getSession();

        $session->set('menus', null);
        $session->set('foods', null);
        
        return $this->redirect($this->generateUrl('YouOrder_new'));
    }

    public function validateAction()
    {
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

        return $this->redirect($this->generateUrl('YouOrder_new'));
    }

    public function helpAction()
    {
        $pusher = $this->container->get('lopi_pusher.pusher');
        $pusher->trigger('youfood_service', 'help', 'La table xx requiert votre assistance.');

        return $this->redirect($this->generateUrl('YouOrder_new'));
    }

    public function statsAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $youOrderFoods = $em->createQuery('SELECT yof, SUM(yof.quantity) quantity FROM YouFoodAdminBundle:YouOrderFood yof GROUP BY yof.food ORDER BY quantity DESC')
                            ->getResult();

        return $this->render('YouFoodAdminBundle:YouOrder:stats.html.twig', array(
            'youOrderFoods' => $youOrderFoods
        ));

    }
}