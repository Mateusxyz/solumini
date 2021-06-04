<?php
    include_once  '../database.php';
    $database=new Database();
    $conn=$database->getConnection();
    $stmt=$conn->query("SELECT company_categories.name, company_categories.id, COUNT(category_id) 
    FROM company_categories LEFT JOIN companies ON company_categories.id = companies.category_id
    GROUP BY company_categories.id");
    echo(json_encode($stmt->fetchAll(PDO::FETCH_ASSOC)));
?>