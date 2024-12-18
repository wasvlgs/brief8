





<?php


$host = "localhost";
$username = "root";
$password = "";
$dbname = "";



$cnx = new mysqli($host,$username,$password,$dbname);


if ($cnx -> connect_errno) {
  echo "Failed to connect to MySQL: " . $cnx -> connect_error;
  exit();
}



?>