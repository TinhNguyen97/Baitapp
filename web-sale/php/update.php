<?php

session_start();
include 'connect.php';
$uploadPath = '';
if (isset($_FILES["image"])) {
  $tmpFilePath = $_FILES['image']['tmp_name'];
  if ($tmpFilePath) {
    $uploadPath = 'image/' . $_FILES['image']['name'];
  };
  move_uploaded_file($tmpFilePath, $uploadPath);
  echo 'Lưu file thành công!';
}
if (isset($_POST)) { {
    $only = ['name', 'price', 'category', 'image'];
    foreach ($only as $item) {
      if (!isset($item) && !isset($_FILES["image"])) {
        die;
      }
    }
    $id = $_POST['id'];
    $name = $_POST['name'];
    $category_id = $_POST['category'];
    $image = $uploadPath;
    $price = $_POST['price'];

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if ($_FILES['image']['error'] <= 0) {
      $stmt = $conn->prepare("UPDATE dish SET name = ? , category_id = ?, image = ? , price =? WHERE id = ?");
      $stmt->bindValue(1, $name);
      $stmt->bindValue(2, $category_id);
      $stmt->bindValue(3, $image);
      $stmt->bindValue(4, $price);
      $stmt->bindValue(5, $id);
      $stmt->execute();
    } else {
      $stmt = $conn->prepare("UPDATE dish SET name = ? , category_id = ? , price =? WHERE id = ?");
      $stmt->bindValue(1, $name);
      $stmt->bindValue(2, $category_id);
      $stmt->bindValue(3, $price);
      $stmt->bindValue(4, $id);
      $stmt->execute();
    }
    header('Content-Type: text/html; charset=utf-8');
    header('Location: /bai-tap/web-sale/php/dish.php');
    $_SESSION['message'] = 'Cập nhật thành công!';
  }
} else {
  echo 'chua submit';
}
