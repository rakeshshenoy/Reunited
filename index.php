<?php
try {
    $conn = new PDO("sqlsrv:server = tcp:rakesh-sql.database.windows.net,1433; Database = rakesh-db", "rakeshshenoy", "Rakesh123");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE TABLE test (
    id INT(6) AUTO_INCREMENT PRIMARY KEY, 
    name VARCHAR(30) NOT NULL
    )";
    $conn->exec($sql);
    echo "Table created!";
}
catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
?>
