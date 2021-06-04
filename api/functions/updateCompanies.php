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
    foreach ($data['table'] as $value) {
        $sql= "UPDATE companies
        SET companies.name = '{$value["name"]}',category_id='{$value["category_id"]}',city='{$value["city"]}',companies.state='{$value["state"]}',companies.description='{$value["description"]}',companies.address='{$value["address"]}', companies.modified='{$date}'
        WHERE companies.id='{$value["id"]}';";
        if ($conn->query($sql) === false) {
            logMe($conn->errorInfo());
          } else {
            
            $result ="OK";
          }
      }
      echo $result
?>