<?php 
$xml = Xml::fromArray(array('response' => $response));
echo $xml->asXML();
?>