<?php
		require_once 'dbConnect.php';
		require_once 'vendor/autoload.php';
		require_once 'HTTP/Request2.php';
		use WindowsAzure\Common\ServicesBuilder;
		use MicrosoftAzure\Storage\Common\ServiceException;
		$connectionString = "DefaultEndpointsProtocol='https';AccountName='rakeshphotos';AccountKey='f2HkSZYQm65pkJ9L4ungJqD7FIMU+5oGIdpxug1eL4YQxz7IuS4ZxIA4Q56BfpNBHL4Zo5cBY0kHFQs7yjUtwg=='";
		// Create blob REST proxy.
		$blobRestProxy = ServicesBuilder::getInstance()->createBlobService($connectionString);
		if($_SERVER['REQUEST_METHOD']=='POST'){
			try    {
				$blobRestProxy->deleteBlob("photos", "test");
				$image = $_POST['image'];
				$content = base64_decode($image);
				$blobRestProxy->createBlockBlob("photos", "test", $content);
			    $mainblob = $blobRestProxy->getBlob("photos", "test");
			    $mainimg = $mainblob->getContentStream();

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
				    'returnFaceId' => 'true'
				);
				$url->setQueryVariables($parameters);
				$request->setMethod(HTTP_Request2::METHOD_POST);
				$request->setBody($mainimg);
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
				$mainFaceID = json_decode($y);
				$mainFaceID = $mainFaceID[0]->{"faceId"};
				//echo $mainFaceID;

				$query = $conn->prepare('SELECT id FROM LostPersons');
	    		$query->execute();
				while ($id = $query->fetch()) {
					//$id = 22;
					//echo $id;
					$blob = $blobRestProxy->getBlob("photos", intval($id[0]));
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
					//var_dump($y);
					$faceID = json_decode($y);
					$faceID = $faceID[0]->{"faceId"};
					echo $faceID;

					$request2 = new Http_Request2('https://westus.api.cognitive.microsoft.com/face/v1.0/verify');
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
					$request2->setBody('{
	    "faceId1":"'.$faceID.'",
	    "faceId2":"'.$mainFaceID.'"
	}');

					try
					{
					    $response2 = $request2->send();
					    $result = json_decode($response2->getBody(), true);
					    //echo $result;
					    $isIdentical = $result["isIdentical"];
					    if($isIdentical)
					    	echo "True".intval($id[0]);
					}
					catch (HttpException $ex)
					{
					    echo $ex;
					}
				}
				echo "False";
			}
			catch(ServiceException $e){
				$code = $e->getCode();
				$error_message = $e->getMessage();
				echo $code.": ".$error_message."<br />";
			}
		}
?>