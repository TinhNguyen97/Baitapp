<?php
include 'connect.php';
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stm = $conn->prepare("SELECT * from category");
$stm->setFetchMode(PDO::FETCH_OBJ);
$stm->execute();
$result = $stm->fetchAll();
echo json_encode($result);
