<?php
ini_set('display_errors', 1);
try {
    $conn = new PDO("sqlsrv:server = tcp:rakesh-sql.database.windows.net,1433; Database = rakesh-db", "rakeshshenoy", "Rakesh123");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = $conn->mssql_query('SELECT id FROM test');

	// Check if there were any records
	/*if (!mssql_num_rows($query)) {
	    echo 'No records found';
	} else {
	    while ($row = mssql_fetch_array($query)) {
        	echo $row['id'], $row['name'], PHP_EOL;
	    }
	}*/

	// Free the query result
	mssql_free_result($query);
}
catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
?>
