<?php
// Autoload files using the Composer autoloader.
require_once __DIR__ . '/../vendor/autoload.php';

require_once ('db.info.php');

$db = new mysqli ( DB_HOST, DB_USER, DB_PASS, DB_BASE );


if($db->connect_error){
    die("Connection failed: " . $db->connect_error);

}

// sql to create users table
$sql = "CREATE TABLE IF NOT EXISTS users (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(60) NOT NULL UNIQUE
)";

if ($db->query($sql) === TRUE) {
    echo "Table users created successfully";
} else {
    echo "Error creating table: " . $db->error;
}

//sql to create table messages
$sql = 'CREATE TABLE IF NOT EXISTS messages (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    message TEXT NOT NULL,
    user_id INT UNSIGNED,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE  
    )';


if ($db->query($sql) === TRUE) {
    echo "Table messages created successfully";
} else {
    echo "Error creating table: " . $db->error;
}

//sql to create subscriptions table
$sql = "CREATE TABLE IF NOT EXISTS subscriptions (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED,
    user_sub_id INT UNSIGNED,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (user_sub_id) REFERENCES users(id) ON DELETE CASCADE 
    )";


if ($db->query($sql) === TRUE) {
    echo "Table subscriptions created successfully";
} else {
    echo "Error creating table: " . $db->error;
}    




?>