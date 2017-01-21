<?php
	require_once 'vendor/autoload.php';
	require_once 'dbConnect.php';
	require_once 'HTTP/Request2.php';

	use WindowsAzure\Common\ServicesBuilder;
	use MicrosoftAzure\Storage\Blob\Models\CreateContainerOptions;
	use MicrosoftAzure\Storage\Blob\Models\PublicAccessType;
	use MicrosoftAzure\Storage\Common\ServiceException;

	if($_SERVER['REQUEST_METHOD']=='POST'){
		$connectionString = "DefaultEndpointsProtocol='https';AccountName='rakeshphotos';AccountKey='TsV+ILARvx/vtkRg9eM7j6REB517SAu9ne8jzvuTtILRUSV0fEKKqbwwE1iPqkLR73xt3vgoTCzgHXyeeVTxDQ=='";

		// Create blob REST proxy.
		$blobRestProxy = ServicesBuilder::getInstance()->createBlobService($connectionString);
		//echo "Blob service created".PHP_EOL;
	 
		$image = $_POST['image'];
		$name = $_POST['name'];
		$contactName = $_POST['contactName'];
		$contactPhone = $_POST['contactPhone'];
		//$lat = $_POST['lat'];
		//$lon = $_POST['lon'];

		$lat = 5;
		$lon = 5;

		$query = $conn->prepare('SELECT id FROM LostPersons ORDER BY id ASC');
		$query->execute();
		$id = 0;
		
		while($row = $query->fetch()){
			$id = $row['id'];
		}

		$id++;
		$content = base64_decode($image);

		try    {
		    //Upload blob
		    $blobRestProxy->createBlockBlob("photos", $id, $content);
		    //echo "Success! Blob uploaded!".PHP_EOL;
		}
		catch(ServiceException $e){
		    // Handle exception based on error codes and messages.
		    // Error codes and messages are here:
		    // http://msdn.microsoft.com/library/azure/dd179439.aspx
		    $code = $e->getCode();
		    $error_message = $e->getMessage();
		    echo $code.": ".$error_message."<br />".PHP_EOL;
		}

		// Get Face ID using Microsoft
		$request = new Http_Request2('https://westus.api.cognitive.microsoft.com/face/v1.0/detect');
		$url = $request->getUrl();

		$headers = array(
		    // Request headers
		    'Content-Type' => 'application/json',
		    'Ocp-Apim-Subscription-Key' => '{dd51642516ac431a9c593b4c78b8a806}',
		);

		$request->setHeader($headers);

		$parameters = array(
		    // Request parameters
		    'returnFaceId' => 'true',
		    'returnFaceLandmarks' => 'true',
		    'returnFaceAttributes' => '{string}',
		);

		$url->setQueryVariables($parameters);

		$request->setMethod(HTTP_Request2::METHOD_POST);

		// Request body
		$request->setBody('{$content}');

		try
		{
		    $response = $request->send();
		    //echo $response->getBody();
		}
		catch (HttpException $ex)
		{
		    echo $ex;
		}

		$faceID = $response[0]['faceId'];
		//echo $name.' '.$contactName.' '.$contactPhone;
		echo $faceID;
		//echo $faceID.PHP_EOL;
		//echo $request[0]['faceLandmarks']['pupilLeft']['x'].PHP_EOL;
		//echo $request[1]['faceAttributes']['age'].PHP_EOL;
		//$sql = "INSERT INTO LostPersons (name, faceID, contactName, contactPhone, lastSeenLat, lastSeenLon) VALUES ('$name','$faceID', '$contactName', '$contactPhone', '$lat', '$lon')";
		//echo "Successfully Uploaded".PHP_EOL;
	 }
?>

