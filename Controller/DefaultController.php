<?php

namespace Qwer\LottoClientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/")
 */
class DefaultController extends Controller
{
    /**
     *
     * @var \JMS\Serializer\Serializer
     */
    private $serializer;
    /**
     * @Route("/client")
     * @Template()
     */
    public function indexAction()
    {
        $url = "http://lotto/tokens/123/currencies/USD.json";
        $ch = curl_init($url);
        $this->serializer = $this->get("jms_serializer");
        $info = new \Qwer\LottoClientBundle\Entity\AuthenticationInfo();
        $info->setLogin("vassa");
        $info->setPassword("123");
        $data = $this->serializer->serialize($info, "json");
        $request["data"] = $data;
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
        $responseRaw = curl_exec($ch);
        $response = json_decode($responseRaw);
        $token = $response->data->token;
        //$token = $this->getToken();
        return array('token' => $token);
    }
}
