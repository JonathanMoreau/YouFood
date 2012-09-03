<?php

namespace YouFood\CookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Response;


class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('YouFoodCookBundle:Default:index.html.twig');
    }

    public function listAction()
    {
        return $this->render('YouFoodCookBundle:Default:list.html.twig');
    }

    public function readyAction($number)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $board = $em->getRepository('YouFoodAdminBundle:Board')->findOneByNumber($number);

    	$pusher = $this->container->get('lopi_pusher.pusher');
        $pusher->trigger('youfood_service', 'order_ready', array('board' => $number, 'user' => $board->getZone()->getUser()->getName()));

        return new Response(json_encode(array('status' => 'ok')));
    }
}
