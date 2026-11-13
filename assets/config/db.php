<?php
$hostname_tourly = "localhost";
$database_tourly = "tourly";
$username_tourly = "tourly";
$password_tourly = "tourly";


try {
  $forum = new PDO("mysql:host=$hostname_tourly;dbname=$database_tourly", 
  $username_tourly, $password_tourly);
  // set the PDO error mode to exception
  $tourly->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//  echo "Connected successfully"; // denna rad kan tas bort om allt fungerar
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}