<?php
declare(strict_types=1);
namespace Mono\Models;

use \mysqli;
	
class Subscription extends DbConnect
{ 

	// **********************
	// ATTRIBUTE DECLARATION
	// **********************

	private $id;   // KEY ATTR. WITH AUTOINCREMENT	
	
	private $user_id;

	private $user_sub_id;

	private $db; 
	

	// **********************
	// CONSTRUCTOR METHOD
	// **********************
        								
        								

	public function __construct() {
        $dbcon = new parent();
        $this->db = $dbcon->connect();
	}

	public function load(mysqli $db, $id)
	{
		$this->id = $id;


		$sql = "SELECT * FROM subscriptions WHERE id = '".$this->id."'";
		$result =  $this->db->query($sql) or die($this->db->error." <br/> Error: ".basename(__FILE__, ".php")." @ line ".__LINE__);
		if($result && $result->num_rows > 0)
		{
			$row = $result->fetch_object();

			$this->id = $row->id;
			$this->user_id = $row->user_id;
			$this->user_sub_id = $row->user_sub_id;


			return true;
		}
		return false;
	}



	// **********************
	// GETTER METHODS
	// **********************

	public function get_id()							{	return $this->id;							}
	public function get_user_id()				            {	return $this->user_id;				}
	public function get_user_sub_id()				            {	return $this->user_sub_id;				}


	// **********************
	// SETTER METHODS
	// **********************
	public function set_db($db) 					{	$this->db = $db;	}
	public function set_id($val)					{	$this->id						=	 $val;	}
	public function set_user_id($val)			        {	$this->user_id			=	 $val;	}
	public function set_user_sub_id($val)			        {	$this->user_sub_id			=	 $val;	}


    // **********************
    // INSERT
    // **********************

    public function create()
    {
        $this->id = ""; // clear key for autoincrement

        $sql = "INSERT INTO subscriptions ( user_id,user_sub_id ) VALUES ( '".$this->user_id."','".$this->user_sub_id."')";
        $result = $this->db->query($sql) or die($this->db->error." <br/> Error: ".basename(__FILE__, ".php")." @ line ".__LINE__);
        $this->id = $this->db->insert_id;

    }

	// **********************
	// DELETE
	// **********************

	public function delete()
	{
		$sql = "DELETE FROM subscriptions WHERE id = '".$this->id."'";
		$result = $this->db->query($sql) or die($this->db->error." <br/> Error: ".basename(__FILE__, ".php")." @ line ".__LINE__);
	}


	// **********************
	// UPDATE
	// **********************

	public function save_info()
	{
		$sql = " UPDATE subscriptions SET  user_id = '".$this->user_id."',user_sub_id = '".$this->user_sub_id."' WHERE id = '".$this->id."' ";
		$result = $this->db->query($sql) or die($this->db->error." <br/> Error: ".basename(__FILE__, ".php")." @ line ".__LINE__);

	}

} // class : end
?>