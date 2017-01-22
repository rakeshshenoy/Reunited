<?php
	require_once 'vendor/autoload.php';
	require_once 'dbConnect.php';

	use WindowsAzure\Common\ServicesBuilder;
	use MicrosoftAzure\Storage\Blob\Models\CreateContainerOptions;
	use MicrosoftAzure\Storage\Blob\Models\PublicAccessType;
	use MicrosoftAzure\Storage\Common\ServiceException;

	echo "Hello!";

	/* Create LostPersons Table
	$sql = "CREATE TABLE LostPersons (
    	id INT PRIMARY KEY, 
    	name VARCHAR(30) NOT NULL,
    	faceID VARCHAR(50) NOT NULL,
    	image VARCHAR(30) NOT NULL,
    	contactName VARCHAR(30) NOT NULL,
    	contactPhone VARCHAR(10) CHECK (len(contactPhone)=10) NOT NULL
    )";
    $conn->exec($sql);
    echo "Table created!"; */

	/*$connectionString = "DefaultEndpointsProtocol='https';AccountName='rakeshphotos';AccountKey='TsV+ILARvx/vtkRg9eM7j6REB517SAu9ne8jzvuTtILRUSV0fEKKqbwwE1iPqkLR73xt3vgoTCzgHXyeeVTxDQ=='";

	// Create blob REST proxy.
	$blobRestProxy = ServicesBuilder::getInstance()->createBlobService($connectionString);
	echo "Blob service created";

	$content = fopen("myfile.txt", "r");
	$blob_name = "testblob";

	try    {
	    //Upload blob
	    $blobRestProxy->createBlockBlob("photos", $blob_name, $content);
	    echo "Success! Blob uploaded!";
	}
	catch(ServiceException $e){
	    // Handle exception based on error codes and messages.
	    // Error codes and messages are here:
	    // http://msdn.microsoft.com/library/azure/dd179439.aspx
	    $code = $e->getCode();
	    $error_message = $e->getMessage();
	    echo $code.": ".$error_message."<br />";
	}*/

	/*try {
	    /*$query = $conn->prepare("INSERT INTO test  (id,name) VALUES ('2','Snehal')");
	    $query->execute();
	    $query = $conn->prepare('SELECT * FROM test');
	    $query->execute();
		while ($row = $query->fetch()) {
	        echo $row['name'];
		}
	}
	catch (PDOException $e) {
	    echo $sql . "<br>" . $e->getMessage();
	}*/
?>
