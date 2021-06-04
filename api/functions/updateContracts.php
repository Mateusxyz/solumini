<?php
    include_once  '../database.php';
    include_once './log.php';
    $database=new Database();
    $conn=$database->getConnection();
    $json = file_get_contents('php://input');
    $data = json_decode($json,true);
    $result;

    foreach ($data['table'] as $value) {
        $sql= "UPDATE contracts
        SET contracts.company_owner = '{$value["company_owner"]}',company_id='{$value["company_id"]}',seller_name='{$value["seller_name"]}',contracts.expire_date='{$value["expire_date"]}' WHERE contracts.id='{$value["id"]}';";
        if ($conn->query($sql) === false) {
            logMe($conn->errorInfo());
          } else {
            
            $result ="OK";
          }
      }
      echo $result
?>