<?php

namespace HomeBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/home", name="reclamation")
     * @param Request $request
     */
    public function indexAction(Request $request)
    {
        die('todos');
    }
}
