<?php
    include_once  '../database.php';
    $database=new Database();
    $conn=$database->getConnection();
    $stmt=$conn->query("SELECT * from companies");
    echo(json_encode($stmt->fetchAll(PDO::FETCH_ASSOC)));
?>