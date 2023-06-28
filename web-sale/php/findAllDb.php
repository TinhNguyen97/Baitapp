<?php
include 'connect.php';
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stm = $conn->prepare("SELECT dish.id, dish.name,
dish.price,
dish.image, 
category.name AS category , 
dish.top_sale, 
dish.desc,
dish.discount,
dish.create_date
FROM category join dish ON category.id = dish.category_id");
$stm->setFetchMode(PDO::FETCH_OBJ);
$stm->execute();
$result = $stm->fetchAll();
echo json_encode($result);
