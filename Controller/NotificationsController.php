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
        $data = json_decode($request->get('data'));
        foreach($data->bets as $bet){
            $id = $bet->externalId;
            $user = $this->getUserById($id);
            $newAmount = $user->getAmount() + $bet->summa2;
            $user->setAmount($newAmount);
            $newMsg= $user->getMsg()." \n ";
            if($bet->summa2>0) {
                $newMsg= $newMsg."  Win id=". $bet->id."  sum=". $bet->summa2;
            } else {
                $newMsg= $newMsg."  Lose id=". $bet->id."  sum=". $bet->summa1;
                
            }
            $user->setMsg($newMsg);
        }
        
        $em = $this->getDoctrine()->getManager();
        $em->flush();
        return new Response($request->get("data"));
    }

    /**
     * @Route("/funds")
     * @param \Symfony\Component\HttpFoundation\Request $request
     */
    public function fundsAction(Request $request)
    {
        $id = $request->get('id');
        $currency = $request->get('currency');
        $amount = $request->get('amount');
        
        $user = $this->getUserById($id);
        $result = $user->getAmount() >= $amount? 'success': 'fail';
        $json = json_encode(array('result' => $result));
        return new Response($json);
    }
    
    /**
     * 
     * @param integer $id
     * @return \Qwer\LottoClientBundle\Entity\Client
     */
    private function getUserById($id){
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository("QwerLottoClientBundle:Client");
        $user = $repo->find($id);
        return $user;
    }
    
    /**
     * @Route("/bets")
     * @param \Symfony\Component\HttpFoundation\Request $request
     */
    public function betsAction(Request $request)
    {
        $data = json_decode($request->get('data'));
 
        foreach($data->bets as $bet){
            $id = $bet->externalId;
            $user = $this->getUserById($id);
            $newAmount = $user->getAmount() - $bet->summa1;
            $user->setAmount($newAmount);
            $newMsg= $user->getMsg()." \n ";
            $newMsg= $newMsg."  Bet id=". $bet->id."  sum=". $bet->summa1;
            $user->setMsg($newMsg);
        }
        
        $em = $this->getDoctrine()->getManager();
        $em->flush();
        $json = json_encode(array("result" => 'success'));
        return new Response($json);
    }

}