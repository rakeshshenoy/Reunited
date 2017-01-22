<?php
	require_once 'HTTP/Request2.php';
	require_once 'vendor/autoload.php';
	require_once 'dbConnect.php';

	use WindowsAzure\Common\ServicesBuilder;
	use MicrosoftAzure\Storage\Blob\Models\CreateContainerOptions;
	use MicrosoftAzure\Storage\Blob\Models\PublicAccessType;
	use MicrosoftAzure\Storage\Common\ServiceException;

	function getFaceID($image)
	{
		// Get Face ID using Microsoft
		$request = new Http_Request2('https://westus.api.cognitive.microsoft.com/face/v1.0/detect');
		$url = $request->getUrl();

		$headers = array(
		    // Request headers
		    'Content-Type' => 'application/octet-stream',
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
		$request->setBody("{$image}");

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
		return $faceID;
	}

	if($_SERVER['REQUEST_METHOD']=='POST'){
		$image = $_POST['image'];
		$faceID = getFaceID($image);
		echo $faceID;
		//echo "Hello!";
	}
?>