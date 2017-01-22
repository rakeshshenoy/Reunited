<?php
	echo "hi";
	require_once 'HTTP/Request2.php';
	require_once 'vendor/autoload.php';
	require_once 'dbConnect.php';

	use WindowsAzure\Common\ServicesBuilder;
	use MicrosoftAzure\Storage\Blob\Models\CreateContainerOptions;
	use MicrosoftAzure\Storage\Blob\Models\PublicAccessType;
	use MicrosoftAzure\Storage\Common\ServiceException;

	
?>