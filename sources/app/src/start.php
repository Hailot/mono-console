<?php
// Autoload files using the Composer autoloader.
require_once __DIR__ . '/../vendor/autoload.php';

require_once ('db.info.php');

$db = new mysqli ( DB_HOST, DB_USER, DB_PASS, DB_BASE );


if($db->connect_error){
    die("Connection failed: " . $db->connect_error);

}

//Open I/O Stream
$stdin = fopen('php://stdin', 'r');
//variable for continous running
$running   = false;

while (!$running)
{
	echo 'y or n? ';

	$input = trim(fgets($stdin));

	if ($input == 'exit')
	{
		exit('Exit Application !!');
	}
}

?>