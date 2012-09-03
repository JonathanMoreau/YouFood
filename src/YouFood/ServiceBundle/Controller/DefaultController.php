<?php

namespace YouFood\ServiceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('YouFoodServiceBundle:Default:index.html.twig');
    }

    public function listAction()
    {
        return $this->render('YouFoodServiceBundle:Default:list.html.twig');
    }
}
