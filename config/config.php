<?php

$servername = "localhost";//localhost
$db_name = 'forum';
$username = 'e2g7wad_php';
$password = 'm,LHqb?vugO%'; // Leave blank if no password
try {
  $conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}