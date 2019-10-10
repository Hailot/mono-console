<?php
// Autoload files using the Composer autoloader.
require_once __DIR__ . '/../vendor/autoload.php';

require_once ('db.info.php');

$db = new mysqli ( DB_HOST, DB_USER, DB_PASS, DB_BASE );


if($db->connect_error){
    die("Connection failed: " . $db->connect_error);

}

print ("Hello World from a console app made with ExeOutput for PHP!\n");



//print (exo_get_protstring('str1'));



fputs(STDOUT, "\nThe Amazing Favourite Colour Script\n");

    fputs(STDOUT, "What is your favourite colour? ");



    $sometext = strtolower(trim(fgets(STDIN, 256)));

    fputs(STDOUT, "Your favourite colour is $sometext!\n\n");

?>