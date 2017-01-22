<?php
	require_once 'HTTP/Request2.php';
	// Get Face ID using Microsoft
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
		    'returnFaceId' => 'true',
		    'returnFaceLandmarks' => 'true'
		);

		$url->setQueryVariables($parameters);

		$request->setMethod(HTTP_Request2::METHOD_POST);

		// Request body
		//$request->setBody("{'url':".$imgurl."}");
		$request->setBody("{'url':".$imgurl."}");

		try
		{
		    $response = $request->send();
		}
		catch (HttpException $ex)
		{
		    echo $ex;
		}

		$jsonstring = $response->getBody();
		$faceID = json_decode($jsonstring)[0]->{"faceId"};
		echo $faceID;
?>