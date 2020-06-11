<?php

namespace SoapClient;

use SoapClient\Secteur;
use SoapClient\Command;

require_once("./Command.php");
require_once("./Category.php");

ini_set("soap.wsdl_cache_enabled", "0");
$options=array('trace'=>1, 'encoding'=>'UTF-8', 'soap_version'=>SOAP_1_2, 'classmap' => ['CommandSoap' => "\SoapClient\Command", 'CategorySoap' => "\SoapClient\Category"]);
try {
    $soapClient = new \SoapClient('http://nginx:80/soap?wsdl', $options);
} catch (SoapFault $e) {
    var_dump($e);
}

try {
    $functions = $soapClient->__getFunctions();
    var_dump ($functions);
    $result = $soapClient->__soapcall("sayHello", array("John"));
    echo '<p>'.$result.'</p>';
    $result = $soapClient->__soapcall("sumHello", array(2,5));
    echo '<p>'.$result.'</p>';

    echo '<br>';

    $command = $soapClient->__soapcall("getLastCommandForUserId", [5]);

    echo '<p> id de la dernière commande : '.$command->getId().'</p>';
    echo '<p> status de la dernière commande : '.$command->getStatus().'</p>';
    echo '<p> date de la dernière commande : '. $command->getCreatedAt() .'</p>';

    // var_dump($command);

    echo '<br>';

    $categorie = $soapClient->__soapcall("getCategorieFromProductId", [4]);

    //    $rawResult = $soapClient->__getLastResponse();
    //    var_dump($rawResult);

    echo '<p> Description de la catégorie du produit : '.$categorie->getDescription().'</p>';
    echo '<p> Image URI de la catégorie du produit : '.$categorie->getImageUri().'</p>';
    echo '<p> Label de la catégorie du produit : '. $categorie->getLabel() .'</p>';
    echo '<p> ID de la catégorie du produit : '. $categorie->getId() .'</p>';


    /*echo '<p>'.$secteur.'</p>';*/

} catch(SoapFault $fault){
    // <xmp> tag displays xml output in html
    echo 'Request : <br/><xmp>',
    $soapClient->__getLastRequest(),
    '</xmp><br/><br/> Error Message : <br/>',
    $fault->getMessage();
    $fault->getTraceAsString();
}
?>
