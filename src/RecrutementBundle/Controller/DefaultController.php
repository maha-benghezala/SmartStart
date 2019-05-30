<?php

namespace RecrutementBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/recrutement", name="recrutement")
     * @param Request $request
     */
    public function indexAction(Request $request)
    {
       die('hello');
    }
}
