<?php
// Autoload files using the Composer autoloader.
require_once __DIR__ . '/../vendor/autoload.php';

require_once ('db.info.php');

$db = new mysqli ( DB_HOST, DB_USER, DB_PASS, DB_BASE );


if($db->connect_error){
    die("Connection failed: " . $db->connect_error);

}

// sql to create table
$sql = "CREATE TABLE users (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(60) NOT NULL
)";

if ($db->query($sql) === TRUE) {
    echo "Table users created successfully";
} else {
    echo "Error creating table: " . $db->error;
}

?>