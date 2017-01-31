<?php
require_once 'vendor/autoload.php';
require_once 'HTTP/Request2.php';

$request = new Http_Request2('https://westus.api.cognitive.microsoft.com/face/v1.0/detect');
				$url = $request->getUrl();
				$headers = array(
				    // Request headers
				    'Content-Type' => 'application/json',
				    'Ocp-Apim-Subscription-Key' => 'dd51642516ac431a9c593b4c78b8a806',
				);
				$request->setHeader($headers);
				$parameters = array(
				    // Request parameters
				    'returnFaceId' => 'true'
				);
				$url->setQueryVariables($parameters);
				$request->setMethod(HTTP_Request2::METHOD_POST);
				$request->setBody('{
    "url":"http://media.gq.com/photos/5711559a3c2c86f474dc6d5a/master/pass/chris-paul-3.jpg"
}');
				try
				{
				    $response = $request->send();
				}
				catch (HttpException $ex)
				{
				    echo $ex;
				}
				$y = $response->getBody();
				//var_dump($y);
				$mainFaceID = json_decode($y, true);
				echo $mainFaceID;
?>