<?php
	require_once 'HTTP/Request2.php';
	//require_once 'vendor/autoload.php';
	//require_once 'dbConnect.php';
	//include 'new.php';

	//$z = getFaceID(10);
	//var_dump($z);

	//use WindowsAzure\Common\ServicesBuilder;
	//use MicrosoftAzure\Storage\Common\ServiceException;

	//echo "Hello!";

	//$query = $conn->prepare('SELECT id from LostPersons');
				//$query->execute();
				//while($row = $query->fetch())
				//{
					// Get blob.
					//$id = $row['id'];
					/*$blob = $blobRestProxy->getBlob("photos", 10);
					$x = $blob->getContentStream();
					$request->setBody($x);
					try
					{
					    $response = $request->send();
					}
					catch (HttpException $ex)
					{
					    echo $ex;
					}
					$y = $response->getBody();
					$faceID = json_decode($y)[0]->{"faceId"};*/
					$request2 = new Http_Request2('https://westus.api.cognitive.microsoft.com/face/v1.0/verify');
					$url2 = $request2->getUrl();

					$headers2 = array(
					    // Request headers
					    'Content-Type' => 'application/json',
					    'Ocp-Apim-Subscription-Key' => 'dd51642516ac431a9c593b4c78b8a806'
					);

					$request2->setHeader($headers2);

					$parameters2 = array(
					    'isIdentical' => 'true'
					);

					$url2->setQueryVariables($parameters2);

					$request2->setMethod(HTTP_Request2::METHOD_POST);

					// Request body
					//$request2->setBody("{'faceId1':'1bae8ae8-ab68-452d-8c18-cb41a23213e1','faceId2':'5eedf2ab-f981-41c2-8ead-715d8c4b4d2a'}");

					/*try
					{
					    $response2 = $request2->send();
					    $result = $response2->getBody();
					    var_dump($result);
					    $isIdentical = $result->{'isIdentical'};
					    if($isIdentical)
					    	echo "True".$id;
					}
					catch (HttpException $ex)
					{
					    echo $ex;
					}*/
				//}
?>