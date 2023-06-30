<?php

session_start();
include 'connect.php';
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $checkImage = $conn->prepare("SELECT dish.image FROM `dish` WHERE id = ?");
  $checkImage->bindValue(1, $id);
  $checkImage->execute();
  $imageArr = $checkImage->fetch();
  if ($imageArr && file_exists($imageArr['image'])) {
    unlink($imageArr['image']);
  }
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("DELETE FROM dish WHERE id = ?");
  $stmt->bindValue(1, $id);
  $stmt->execute();


  header('Content-Type: text/html; charset=utf-8');
  header('Location: ../admin/admin.php');

  $_SESSION['message'] = 'Xóa thành công!';
}
