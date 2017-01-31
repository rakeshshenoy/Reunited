/*$request2 = new Http_Request2('https://westus.api.cognitive.microsoft.com/face/v1.0/verify');
				$url2 = $request2->getUrl();

				$headers2 = array(
				    // Request headers
				    'Content-Type' => 'application/json',
				    'Ocp-Apim-Subscription-Key' => 'dd51642516ac431a9c593b4c78b8a806'
				);

				$request2->setHeader($headers2);

				$parameters2 = array(
				);

				$url2->setQueryVariables($parameters2);

				$request2->setMethod(HTTP_Request2::METHOD_POST);

				// Request body
				$request2->setBody("{
    'faceId1':'$faceID',
    'faceId2':'$mainFaceID'
}");

				try
				{
				    $response2 = $request2->send();
				    $result = $response2->getBody();
				    $isIdentical = json_decode($result)[0]->{'isIdentical'};
				    if($isIdentical)
				    	echo "True".$id;
				}
				catch (HttpException $ex)
				{
				    echo $ex;
				}

				echo "False";