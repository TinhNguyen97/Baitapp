<?php
include 'connect.php';
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stm = $conn->prepare("SELECT dish.id, dish.name,dish.price,dish.image, category.name AS category, dish.top_sale, dish.desc, dish.discount from dish
 left join category on dish.category_id = category.id where dish.top_sale = 1 limit 4");
$stm->setFetchMode(PDO::FETCH_OBJ);
$stm->execute();
$result = $stm->fetchAll();
echo json_encode($result);
