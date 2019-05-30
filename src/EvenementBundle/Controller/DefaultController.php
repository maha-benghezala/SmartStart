<?php

namespace EvenementBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class DefaultController extends Controller
{

    public function indexAction(Request $request)
    {
        return $this->render('ProfilBundle:Default:index.html.twig');
    }

}
