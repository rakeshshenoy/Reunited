<?php
	//function getFaceID($id)
	//{
		$image = $_POST['image'];
		$content = base64_decode($image);
		//$contentimg = $content->getContentStream();
		$id = 18;
		require_once 'vendor/autoload.php';
		require_once 'HTTP/Request2.php';
		use WindowsAzure\Common\ServicesBuilder;
		use MicrosoftAzure\Storage\Common\ServiceException;
		$connectionString = "DefaultEndpointsProtocol='https';AccountName='rakeshphotos';AccountKey='f2HkSZYQm65pkJ9L4ungJqD7FIMU+5oGIdpxug1eL4YQxz7IuS4ZxIA4Q56BfpNBHL4Zo5cBY0kHFQs7yjUtwg=='";
		// Create blob REST proxy.
		$blobRestProxy = ServicesBuilder::getInstance()->createBlobService($connectionString);

		try    {
		    $blobRestProxy->createBlockBlob("photos", 0, $content);
		    $mainblob = $blobRestProxy->getBlob("photos", 0);
		    $mainimg = $mainblob->getContentStream();
		    $blobRestProxy->deleteBlob("photos", 0);
		}
		catch(ServiceException $e){
		    $code = $e->getCode();
		    $error_message = $e->getMessage();
		    echo $code.": ".$error_message."<br />".PHP_EOL;
		}

		try    {
			// Get blob.
			$blob = $blobRestProxy->getBlob("photos", $id);
			$x = $blob->getContentStream();
			//echo $x;
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
			$z = json_decode($y)[0]->{"faceId"};
			echo $z;
			//echo $response;
		}
		catch(ServiceException $e){
			$code = $e->getCode();
			$error_message = $e->getMessage();
			echo $code.": ".$error_message."<br />";
			//return NULL;
		}
		//return NULL;
	//}
?>