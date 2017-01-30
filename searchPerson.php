<?php
require_once 'HTTP/Request2.php';

echo "Hello!";
$request = new Http_Request2('https://westus.api.cognitive.microsoft.com/face/v1.0/verify');
$url = $request->getUrl();

$headers = array(
    // Request headers
    'Content-Type' => 'application/json',
    'Ocp-Apim-Subscription-Key' => 'dd51642516ac431a9c593b4c78b8a806'
);

$request->setHeader($headers);

$parameters = array(
    // Request parameters
);

$url->setQueryVariables($parameters);

$request->setMethod(HTTP_Request2::METHOD_POST);
?>