<?php
include 'connect.php';
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("SELECT dish.id, dish.name,dish.price,dish.image, dish.category_id, category.name AS category ,dish.desc, dish.discount
  FROM category right join dish ON category.id = dish.category_id WHERE dish.id =?");
  $stmt->bindValue(1, $id);
  $stmt->execute();
  $stmt->setFetchMode(PDO::FETCH_OBJ);
  $result = $stmt->fetch();
  echo json_encode($result);
}
