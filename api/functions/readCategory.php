<?php
    include_once  '../database.php';
    $database=new Database();
    $conn=$database->getConnection();
    $stmt=$conn->query("SELECT companies.*,company_categories.name AS cat_name,contracts.expire_date AS contract_expire_date FROM companies RIGHT JOIN company_categories ON company_categories.id=companies.category_id LEFT JOIN contracts ON contracts.company_id=companies.id WHERE companies.category_id={$_GET['id']}");
    echo(json_encode($stmt->fetchAll(PDO::FETCH_ASSOC)));
?>