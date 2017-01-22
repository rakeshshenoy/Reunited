<?php
	require_once 'HTTP/Request2.php';
	require_once 'vendor/autoload.php';
	require_once 'dbConnect.php';

	use WindowsAzure\Common\ServicesBuilder;
	use MicrosoftAzure\Storage\Blob\Models\CreateContainerOptions;
	use MicrosoftAzure\Storage\Blob\Models\PublicAccessType;
	use MicrosoftAzure\Storage\Common\ServiceException;

	//function getFaceID($image)
	//{
		// Get Face ID using Microsoft
	//	echo "hi".PHP_EOL;
		/*$request = new Http_Request2('https://westus.api.cognitive.microsoft.com/face/v1.0/detect');
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

		$request->setMethod(HTTP_Request2::METHOD_POST);*/

		// Request body
		//$request->setBody("{'url':".$imgurl."}");
		/*$request->setBody($image);

		try
		{
		    $response = $request->send();
		}
		catch (HttpException $ex)
		{
		    echo $ex;
		}*/

		//$jsonstring = $response->getBody();
		//var_dump($jsonstring);
		//$faceID = json_decode($jsonstring)[0]->{"faceId"};
		//$faceID = '';
	//	return "";
	//}

	//if($_SERVER['REQUEST_METHOD']=='POST'){
		//$image = $_POST['image'];
		//$facesID = getFaceID($image);
		//echo $facesID;
		//$query = $conn->prepare("SELECT id from LostPersons");
		//$query->execute();

		$connectionString = "DefaultEndpointsProtocol='https';AccountName='rakeshphotos';AccountKey='TsV+ILARvx/vtkRg9eM7j6REB517SAu9ne8jzvuTtILRUSV0fEKKqbwwE1iPqkLR73xt3vgoTCzgHXyeeVTxDQ=='";

		// Create blob REST proxy.
		$blobRestProxy = ServicesBuilder::getInstance()->createBlobService($connectionString);

		//if ($row = $query->fetch()) {
			try    {
			    // Get blob.
			    $blob = $blobRestProxy->getBlob("photos", 10);
			    fpassthru($blob->getContentStream());
			    //var_dump(base64_encode($blob));
			    //$faceID = getFaceID($blob);
			    //echo $faceID;
			    //echo "Hello";
			}
			catch(ServiceException $e){
			    // Handle exception based on error codes and messages.
			    // Error codes and messages are here:
			    // http://msdn.microsoft.com/library/azure/dd179439.aspx
			    $code = $e->getCode();
			    $error_message = $e->getMessage();
			    echo $code.": ".$error_message."<br />";
			}
		//}
	//}
?>