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
    $sql="INSERT INTO companies (companies.name, companies.category_id, city, companies.state,companies.description,companies.address,companies.created,companies.modified)
    VALUES ('{$data['info']['name']}', '{$data['info']['category_id']}', '{$data['info']['city']}', '{$data['info']['state']}','{$data['info']['description']}','{$data['info']['address']}','{$date}','{$date}');";
    if ($conn->query($sql) === false) {
      logMe($conn->errorInfo());
    } else {
      
      $result ="OK";
    }
     echo $result
?>