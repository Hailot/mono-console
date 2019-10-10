<?php
namespace Mono\models;

use \mysqli;
	
class user
{ 

	// **********************
	// ATTRIBUTE DECLARATION
	// **********************

	private $id;   // KEY ATTR. WITH AUTOINCREMENT
	
	private $name;

	private $db; 
	

	// **********************
	// CONSTRUCTOR METHOD
	// **********************
        								
        								

	public function __construct() {
		
	}

	public function load(mysqli $db, $id)
	{
		$this->db = $db;
		$this->id = $id;


		$sql = "SELECT * FROM users WHERE id = '".$this->id."'";
		$result =  $this->db->query($sql) or die($this->db->error." <br/> Error: ".basename(__FILE__, ".php")." @ line ".__LINE__);
		if($result && $result->num_rows > 0)
		{
			$row = $result->fetch_object();

			$this->id = $row->id;
			$this->name = $row->name;
		

			return true;
		}
		return false;
	}


	// **********************
	// GETTER METHODS
	// **********************

	public function get_id()							{	return $this->id;							}
	public function get_name()				            {	return $this->name;				}


	// **********************
	// SETTER METHODS
	// **********************
	public function set_db($db) 					{	$this->db = $db;	}
	public function set_id($val)					{	$this->id						=	 $val;	}
	public function set_name($val)			        {	$this->name			=	 $val;	}


	// **********************
	// DELETE
	// **********************

	public function delete()
	{
		$sql = "DELETE FROM users WHERE id = '".$this->id."'";
		$result = $this->db->query($sql) or die($this->db->error." <br/> Error: ".basename(__FILE__, ".php")." @ line ".__LINE__);
	}


	// **********************
	// UPDATE
	// **********************

	public function save_info()
	{
		$sql = " UPDATE users SET  name = '".$this->name."' WHERE id = '".$this->id."' ";
		$result = $this->db->query($sql) or die($this->db->error." <br/> Error: ".basename(__FILE__, ".php")." @ line ".__LINE__);

	}

} // class : end
?>