<?php


	define('DB_HOST', 'database');
	define('DB_USER', 'root');
	define('DB_PASS', 'secret');
	define('DB_BASE', 'mono');
	if(!defined('PHPUNIT')) define('PHPUNIT', false);


    if(isset($_SERVER['REQUEST_SCHEME'])) {
        define('DOMAIN_ROOT', $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['SERVER_NAME']);
    }

?>