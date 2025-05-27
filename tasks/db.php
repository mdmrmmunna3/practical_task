<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "taskdb2";


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) { 
    die("database Connect faield". $conn->connect_error);
}
else{
    echo"Database connection Successfully";
}

?>