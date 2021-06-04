<?php
    include_once  '../database.php';
    $database=new Database();
    $conn=$database->getConnection();
    $stmt=$conn->query("SELECT companies.*,company_categories.name as cat_name, company_phones.* from companies LEFT JOIN company_categories ON companies.category_id=company_categories.id LEFT JOIN company_phones ON companies.id=company_phones.company_id WHERE companies.id={$_GET['id']}");
    echo(json_encode($stmt->fetchAll(PDO::FETCH_ASSOC)));
?>