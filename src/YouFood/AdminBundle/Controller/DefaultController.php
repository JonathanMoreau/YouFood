<?php

namespace YouFood\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction()
    {
        return $this->render('YouFoodAdminBundle:Default:index.html.twig');
    }
}
