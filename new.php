<?php
	require_once 'vendor/autoload.php';

	use WindowsAzure\Common\ServicesBuilder;
	use MicrosoftAzure\Storage\Common\ServiceException;

	$connectionString = "DefaultEndpointsProtocol='https';AccountName='rakeshphotos';AccountKey='f2HkSZYQm65pkJ9L4ungJqD7FIMU+5oGIdpxug1eL4YQxz7IuS4ZxIA4Q56BfpNBHL4Zo5cBY0kHFQs7yjUtwg=='";

	// Create blob REST proxy.
	$blobRestProxy = ServicesBuilder::getInstance()->createBlobService($connectionString);
	try    {
		// Get blob.
		$blob = $blobRestProxy->getBlob("photos", 10);
		var_dump($blob);
	}
	catch(ServiceException $e){
		$code = $e->getCode();
		$error_message = $e->getMessage();
		echo $code.": ".$error_message."<br />";
	}
?>