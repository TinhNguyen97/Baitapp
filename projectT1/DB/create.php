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
}
if (isset($_POST['save'])) { {
    $only = ['name', 'price', 'category', 'image', 'descr', 'discount'];
    foreach ($only as $item) {
      if (!isset($item)) {
        die;
      }
    }
    if (!isset($_FILES['image'])) {
      die;
    }
    $name = $_POST['name'];
    $category_id = $_POST['category'];
    $image = $uploadPath;
    $price = $_POST['price'];
    $discount = $_POST['discount'];
    $descr = $_POST['descr'];
    $currentDate = date('Y-m-d');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stm = $conn->prepare("INSERT INTO dish (name, category_id, price, image, discount,descr, create_date ) VALUES (?,?,?,?,?,?,?)");
    $stm->bindValue(1, $name);
    $stm->bindValue(2, $category_id);
    $stm->bindValue(3, $price);
    $stm->bindValue(4, $image);
    $stm->bindValue(5, $discount);
    $stm->bindValue(6, $descr);
    $stm->bindValue(7, $currentDate);
    $stm->execute();
    header('Content-Type: text/html; charset=utf-8');
    header('Location: ../admin/admin.php');

    $_SESSION['message'] = 'Thêm mới  thành công!';
  }
} else {
  echo 'chua submit';
}
