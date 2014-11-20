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
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        $user = $this->getUser();
        $token = "ipp1pmp3n1nc6p5kr0rma46h91";
       // $token = "";
        $lottoUrl = $this->container->getParameter('lotto.url');
       // print( $lottoUrl."\n");
        $clientLottoUrl = $this->container->getParameter('client.lotto.url');
        //
        
      /*   if ($user) {
            $id = $user->getId();
            $rawUrl = $this->container->getParameter('client_lotto.currencies.url');
         //   print( $rawUrl."<br/>"); // /tokens/1/currencies/USD.json
            $url = str_replace(array("{externalId}","{currency}"), array($id, "USD"), $rawUrl);

         //  print($url);

            $ch = curl_init($url);
            $this->serializer = $this->get("jms_serializer");
            $info = new \Qwer\LottoClientBundle\Entity\AuthenticationInfo();
            $info->setLogin("vassa");
            $info->setPassword("123");
            $data = $this->serializer->serialize($info, "json");
            $request["data"] = $data;
         //    print_r($request);
           // curl_setopt($ch, CURLOPT_HEADER, 0);
            
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, 'data={"login":"vassa","password":"123"}');
            $responseRaw = curl_exec($ch);
            

       //     echo  $responseRaw ;
            curl_close($ch);
            $response = json_decode($responseRaw);
            //  print_r($response); 
            $token =  $response->data->token;
        }
*/

        return array(
            'token' => $token,
            'user' => $user,
            'lottoUrl' => $lottoUrl,
            'clientLottoUrl' => $clientLottoUrl,
        );
    }

}
