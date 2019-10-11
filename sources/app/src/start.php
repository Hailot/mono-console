<?php
// Autoload files using the Composer autoloader.

use Mono\CommandHandler;

require_once __DIR__ . '/../vendor/autoload.php';

//Open I/O Stream
$stdin = fopen('php://stdin', 'r');
//variable for continous running
$running   = false;

while (!$running)
{
	echo 'Please enter command! ';

	//Get User input
	$input = trim(fgets($stdin));
	$commandHandler = new CommandHandler($input);
	$commandHandler->handle();
	
	

}



?>