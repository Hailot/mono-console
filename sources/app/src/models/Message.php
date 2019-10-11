<?php
declare(strict_types=1);
namespace Mono\Models;

use DateTime;
use \mysqli;
	
class Message extends DbConnect
{ 

	// **********************
	// ATTRIBUTE DECLARATION
	// **********************

	private $id;   // KEY ATTR. WITH AUTOINCREMENT	
	
	private $message;

	private $user_id;

	private $created_at;

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
		$this->db = $db;
		$this->id = $id;


		$sql = "SELECT * FROM messages WHERE id = '".$this->id."'";
		$result =  $this->db->query($sql) or die($this->db->error." <br/> Error: ".basename(__FILE__, ".php")." @ line ".__LINE__);
		if($result && $result->num_rows > 0)
		{
			$row = $result->fetch_object();

			$this->id = $row->id;
			$this->message = $row->message;
			$this->user_id = $row->user_id;
			$this->created_at = $row->created_at;
		

			return true;
		}
		return false;
	}



	// **********************
	// GETTER METHODS
	// **********************

	public function get_id()							    {	return $this->id;						}
	public function get_message()				            {	return $this->message;				    }
	public function get_user_id()                           {   return $this->user_id;                  }
	public function get_created_at()                        {   return $this->created_at;                 }
    public function get_time_elapsed_string($full = false) {
	    //TODO: implement Carbon instead
        $now = new DateTime;
        try {
            $ago = new DateTime($this->get_created_at());
        } catch (\Exception $e) {
        }
        $diff = (array) $now->diff( $ago );

        $diff['w']  = floor( $diff['d'] / 7 );
        $diff['d'] -= $diff['w'] * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );

        foreach( $string as $k => & $v )
        {
            if ( $diff[$k] )
            {
                $v = $diff[$k] . ' ' . $v .( $diff[$k] > 1 ? 's' : '' );
            }
            else
            {
                unset( $string[$k] );
            }
        }

        if ( ! $full ) $string = array_slice( $string, 0, 1 );
        return $string ? implode( ', ', $string ) . ' ago' : 'just now';
    }


	// **********************
	// SETTER METHODS
	// **********************
	public function set_db($db) 					    {	$this->db               =   $db;	}
	public function set_id($val)					    {	$this->id				=	$val;	}
	public function set_message($val)			        {	$this->message			=	$val;	}
	public function set_user_id($val)                   {   $this->user_id          =   $val;   }
	public function set_created_at($val)                   {   $this->created_at          =   $val;   }

    // **********************
    // INSERT
    // **********************

    public function create()
    {

        $this->id = ""; // clear key for autoincrement

        $sql = "INSERT INTO messages ( message,user_id ) VALUES ( '".$this->message."','".$this->user_id."')";
        $result = $this->db->query($sql) or die($this->db->error." <br/> Error: ".basename(__FILE__, ".php")." @ line ".__LINE__);
        $this->id = $this->db->insert_id;

    }
	// **********************
	// DELETE
	// **********************

	public function delete()
	{
		$sql = "DELETE FROM messages WHERE id = '".$this->id."'";
		$result = $this->db->query($sql) or die($this->db->error." <br/> Error: ".basename(__FILE__, ".php")." @ line ".__LINE__);
	}


	// **********************
	// UPDATE
	// **********************

	public function save_info()
	{
		$sql = " UPDATE messages SET  message = '".$this->message."',user_id = '".$this->user_id."' WHERE id = '".$this->id."' ";
		$result = $this->db->query($sql) or die($this->db->error." <br/> Error: ".basename(__FILE__, ".php")." @ line ".__LINE__);

	}

} // class : end
?>