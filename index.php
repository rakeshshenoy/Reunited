<?php
try {
    $conn = new PDO("sqlsrv:server = tcp:rakesh-sql.database.windows.net,1433; Database = rakesh-db", "rakeshshenoy", "Rakesh123");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "INSERT INTO test  (id,name) VALUES   
('1','Rakesh')";
    $conn->exec($query);
    echo "Table created!";
}
catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
?>
