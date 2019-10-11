<?php
// Autoload files using the Composer autoloader.
require_once __DIR__ . '/../vendor/autoload.php';

require_once('db.info.php');

$db = new mysqli ( DB_HOST, DB_USER, DB_PASS, DB_BASE );


if($db->connect_error){
    die("Connection failed: " . $db->connect_error);

}

/*
 * SEEDERS
 */

//Users seeder
// prepare and bind
$stmt = $db->prepare("INSERT INTO users (name) VALUES (?)");
$stmt->bind_param("s", $name);

$name = "john";
$stmt->execute();
$name = "alice";
$stmt->execute();
$name = "bob";
$stmt->execute();

echo "Users Seeded Succesfully";

$stmt->close();

//Messages Seeder
$stmt = $db->prepare("INSERT INTO messages (message,user_id) VALUES (?, ?)");
$stmt->bind_param("si", $message,$user_id);

echo "Messages seeded succesfully";

$stmt->close();

//Subscriptions Seeder
$stmt = $db->prepare("INSERT INTO subscriptions (user_id,user_sub_id) VALUES (?, ?)");
$stmt->bind_param("ii", $user_id,$user_sub_id);

echo "Subscriptions seeded succesfully";

$stmt->close();


?>