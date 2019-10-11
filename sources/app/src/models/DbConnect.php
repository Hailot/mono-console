<?php


namespace Mono\Models;
use mysqli;

require_once('db.info.php');


class DbConnect
{
    public function connect()
    {
        $db = new mysqli ( DB_HOST, DB_USER, DB_PASS, DB_BASE );


        if($db->connect_error){
            die("Connection failed: " . $db->connect_error);

        }
        return $db;
    }
}