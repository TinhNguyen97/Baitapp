<?php
include 'connect.php';
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stm = $conn->prepare("SELECT dish.id, dish.name,
dish.price,
dish.image, 
category.name AS category , 
dish.top_sale, 
dish.descr,
dish.discount,
(dish.price-dish.price*dish.discount/100) as price_after_sale,
dish.create_date
FROM category join dish ON category.id = dish.category_id
order by dish.create_date DESC limit 4");
$stm->setFetchMode(PDO::FETCH_DEFAULT);
$stm->execute();
$resultNewest = $stm->fetchAll();
