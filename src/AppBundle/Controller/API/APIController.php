<?php

namespace AppBundle\Controller\API;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class APIController
 * @package AppBundle\Controller\API
 */
class APIController extends Controller
{
    /**
     * @Route("/api/status")
     */
    public function apiAction() {
        return new Response('The API works great!');
    }

}