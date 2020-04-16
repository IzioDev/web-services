<?php
ini_set("soap.wsdl_cache_enabled", "0");
$options=array('trace'=>1, 'encoding'=>'UTF-8', 'soap_version'=>SOAP_1_2);
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
} catch(SoapFault $fault){
    // <xmp> tag displays xml output in html
    echo 'Request : <br/><xmp>',
    $soapClient->__getLastRequest(),
    '</xmp><br/><br/> Error Message : <br/>',
    $fault->getMessage();
    $fault->getTraceAsString();
}
?>
