<?php

echo "Hello!"
// This sample uses the Apache HTTP client from HTTP Components (http://hc.apache.org/httpcomponents-client-ga/)
require_once 'HTTP/Request2.php';

$request = new Http_Request2('https://westus.api.cognitive.microsoft.com/face/v1.0/verify');
$url = $request->getUrl();

/*$headers = array(
    // Request headers
    'Content-Type' => 'application/json',
    'Ocp-Apim-Subscription-Key' => 'dd51642516ac431a9c593b4c78b8a806',
);

$request->setHeader($headers);

$parameters = array(
    // Request parameters
);

$url->setQueryVariables($parameters);

$request->setMethod(HTTP_Request2::METHOD_POST);*/

// Request body
/*$request->setBody('{
    "faceId1":"1bae8ae8-ab68-452d-8c18-cb41a23213e1",
    "faceId2":"5eedf2ab-f981-41c2-8ead-715d8c4b4d2a"
}');

try
{
    $response = $request->send();
    var_dump($response->getBody());
}
catch (HttpException $ex)
{
    echo $ex;
}*/

?>