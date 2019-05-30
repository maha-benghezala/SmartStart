<?php

namespace PaimentBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
class DefaultController extends Controller
{
    /**
     * @Route("/paiment", name="peace")
     * @param Request $request
     */
    public function indexAction(Request $request)
    {
        die('tttt');
    }
}
