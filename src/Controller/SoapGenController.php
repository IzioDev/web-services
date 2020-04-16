<?php


namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Laminas\Soap\AutoDiscover;

class SoapGenController
{
    /**
     * @Route("/soapgen", name="soapgen")
     */
    public function soapGenAction()
    {
        $autodiscover = new AutoDiscover();
        $autodiscover->setClass('App\Soap\SoapClass')
            ->setUri('http://nginx:80/soap')
            ->setServiceName('SoapGenService');

        header('Content-Type: application/wsdl+xml');
        $wsdl=$autodiscover->generate();
        $wsdl->dump("../soap.wsdl");
        return new Response($wsdl->toXml());
    }
}