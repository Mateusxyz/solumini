<?php
    include_once  '../database.php';
    include_once './log.php';
    $database=new Database();
    $conn=$database->getConnection();
    $json = file_get_contents('php://input');
    $data = json_decode($json,true);
    $result;
    date_default_timezone_set("America/Sao_Paulo");
    $date=date("Y-m-d H:i:s");
    $sql="INSERT INTO contracts (contracts.company_owner, contracts.company_id, seller_name, expire_date,created)
    VALUES ('{$data['info']['company_owner']}', '{$data['info']['company_id']}', '{$data['info']['seller_name']}', '{$data['info']['expire_date']}','{$date}');";
    if ($conn->query($sql) === false) {
      logMe($conn->errorInfo());
    } else {
      
      $result ="OK";
    }
     echo $result
?>