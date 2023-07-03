<?php
$servername = "localhost";
$username = "root";
$password = "";
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
try {
  $conn = new PDO("mysql:host=127.0.0.1;dbname=tinhtest;port=3307", $username);
} catch (Exception $e) {
  echo [$e->getMessage()];
}
