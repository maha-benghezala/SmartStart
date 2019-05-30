<?php

namespace MarketingBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/marketing", name="marketing")
     * @param Request $request
     */
    public function indexAction(Request $request)
    {
      die ('azerty');
    }
}
