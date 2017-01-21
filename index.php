<?php
try {
    $server = "tcp:rakesh-sql.database.windows.net,1433";
    $username = "rakeshshenoy@rakesh-sql";
    $password = "Rakesh123";
    $dbname = "rakesh-db";
    $conn = new PDO("mysql:host=$server;dbname=$dbname",$username,$password);
    echo "Success!\n";
}
catch ( PDOException $e ) {
   print( "Error connecting to SQL Server." );
   die(print_r($e));
}
?>
