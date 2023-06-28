<?php
session_start();
include 'connect.php';
if (isset($_GET)) {

  $id = $_GET['id'];
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("DELETE FROM dish WHERE id = ?");
  $stmt->bindValue(1, $id);
  $stmt->execute();
  header('Content-Type: text/html; charset=utf-8');
  header('Location: ../admin/admin.php');

  $_SESSION['message'] = 'Xóa thành công!';
}
