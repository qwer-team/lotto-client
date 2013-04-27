<?php

namespace Qwer\LottoClientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class NotificationsController extends Controller
{

    /**
     * @Route("/getResults")
     */
    public function resultAction(Request $request)
    {
        return new Response($request->get("data"));
    }

    /**
     * @Route("/funds")
     * @param \Symfony\Component\HttpFoundation\Request $request
     */
    public function fundsAction(Request $request)
    {
        $json = json_encode(array("result" => 'success'));
        return new Response($json);
    }
    
    /**
     * @Route("/bets")
     * @param \Symfony\Component\HttpFoundation\Request $request
     */
    public function betsAction(Request $request)
    {
        
        $json = json_encode(array("result" => 'success'));
        return new Response($json);
    }

}