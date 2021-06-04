<?php
    include_once  '../database.php';
    include_once './log.php';
    $database=new Database();
    $conn=$database->getConnection();
    $json = file_get_contents('php://input');
    $data = json_decode($json,true);
    $result;
    $sql="DELETE FROM contracts WHERE contracts.id={$data['id']};";
    if ($conn->query($sql) === false) {
      logMe($conn->errorInfo());
    } else {
      
      $result ="OK";
    }
      echo $result
?>