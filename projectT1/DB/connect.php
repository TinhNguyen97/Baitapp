<?php
require_once '../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createMutable(substr(__DIR__, 0, -2));
$dotenv->load();
echo $_ENV['DBNAME'];
$servername = $_ENV['SERVERNAME'];
$username = $_ENV['USERNAME'];
$password = $_ENV['PASSWORD'];
$dbname = $_ENV['DBNAME'];
$port = $_ENV['PORT'];
header('Access-Control-Allow-Origin: *');
try {
  $conn = new PDO("mysql:host=127.0.0.1;dbname=$dbname;port=$port", $username);
} catch (Exception $e) {
  echo [$e->getMessage()];
}
