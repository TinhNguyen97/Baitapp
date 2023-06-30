<?php

session_start();
include 'connect.php';
$uploadPath = '';
if (isset($_FILES["image"])) {
  $tmpFilePath = $_FILES['image']['tmp_name'];
  if ($tmpFilePath) {
    $uploadPath = '../image/' . $_FILES['image']['name'];
  };
  move_uploaded_file($tmpFilePath, $uploadPath);
  echo 'Lưu file thành công!';
}
if (isset($_POST['id'])) { {
    $only = ['name', 'price', 'category', 'image', 'descr', 'discount'];
    foreach ($only as $item) {
      if (!isset($item) && !isset($_FILES["image"])) {
        die;
      }
    }
    $id = $_POST['id'];
    $name = $_POST['name'];
    if (!$name) {
      $_SESSION['name'] = 'Tên món ăn không được để trống!';
      header('Location: ../admin/admin.php');
      die;
    }
    $category_id = $_POST['category'];
    $image = $uploadPath;
    $price = $_POST['price'];
    $descr = $_POST['descr'];
    $discount = $_POST['discount'];

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if ($_FILES['image']['error'] <= 0) {

      $stmt = $conn->prepare("UPDATE dish SET name = ? , category_id = ?, image = ? , price =? , descr=?, discount = ? WHERE id = ?");
      $stmt->bindValue(1, $name);
      $stmt->bindValue(2, $category_id);
      $stmt->bindValue(3, $image);
      $stmt->bindValue(4, $price);
      $stmt->bindValue(5, $descr);
      $stmt->bindValue(6, $discount);
      $stmt->bindValue(7, $id);
      $stmt->execute();
    } else {

      $stmt = $conn->prepare("UPDATE dish SET name = ? , category_id = ? , price =? , descr=?, discount=? WHERE id = ?");
      $stmt->bindValue(1, $name);
      $stmt->bindValue(2, $category_id);
      $stmt->bindValue(3, $price);
      $stmt->bindValue(4, $descr);
      $stmt->bindValue(5, $discount);
      $stmt->bindValue(6, $id);
      $stmt->execute();
    }
    header('Content-Type: text/html; charset=utf-8');
    header('Location: ../admin/admin.php');
    $_SESSION['message'] = 'Cập nhật thành công!';
  }
} else {
  echo 'chua submit';
}
