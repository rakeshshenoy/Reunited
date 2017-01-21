<?php
ini_set('display_errors', 1);
try {
    $conn = new PDO("sqlsrv:server = tcp:rakesh-sql.database.windows.net,1433; Database = rakesh-db", "rakeshshenoy", "Rakesh123");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = $conn->prepare("INSERT INTO test  (id,name) VALUES ('2','Snehal')");
    $query->execute();
    $query = $conn->prepare('SELECT * FROM test');
    $query->execute();
	while ($row = $query->fetch()) {
        echo $row['name'];
	}
}
catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
?>
