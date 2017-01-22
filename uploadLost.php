<?php
	require_once 'vendor/autoload.php';
	require_once 'dbConnect.php';

	use WindowsAzure\Common\ServicesBuilder;
	use MicrosoftAzure\Storage\Blob\Models\CreateContainerOptions;
	use MicrosoftAzure\Storage\Blob\Models\PublicAccessType;
	use MicrosoftAzure\Storage\Common\ServiceException;

	if($_SERVER['REQUEST_METHOD']=='POST'){
		$connectionString = "DefaultEndpointsProtocol='https';AccountName='rakeshphotos';AccountKey='f2HkSZYQm65pkJ9L4ungJqD7FIMU+5oGIdpxug1eL4YQxz7IuS4ZxIA4Q56BfpNBHL4Zo5cBY0kHFQs7yjUtwg=='";

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

		$sql = $conn->prepare("INSERT INTO LostPersons (name, contactName, contactPhone, lastSeenLat, lastSeenLon) VALUES ('$name', '$contactName', '$contactPhone', '$lat', '$lon')");
		$sql->execute();

		$query = $conn->prepare('SELECT max(id) FROM LostPersons');
		$query->execute();
		$row = $query->fetch();
		$id = $row['max(id)'];
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
		echo "Successfully Uploaded";
	 }
?>

