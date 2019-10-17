<?php


namespace Mono\Controllers;


use Mono\Models\DbConnect;
use Mono\Models\Message;
use Mono\Models\User;
use mysqli;

class UserController
{

    /**
     * UserController constructor.
     */
    public function __construct()
    {
    }

    public function getUserFromName($name)
    {
        $user = new User();
        $user->loadFromName($name);
        return $user;
    }

    public function getWall($userId)
    {
        $dbcon= new DbConnect();
        $db = $dbcon->connect();
        $sql = "select id from messages WHERE user_id = " . $userId." ORDER BY created_at DESC";

        $result = $db->query($sql);
        $messages = array();

        while($row = $result->fetch_object()) {

           $message = new Message();
           $message->load($row->id);

            $messages[] = $message;
        }


        /** @var Message $message */
        $now = new \DateTime();
        foreach ($messages as $message) {
            echo $message->get_message() . " (" . $message->get_time_elapsed_string() . ") \n";
        }
    }

    public function getWallWithSubscriptions($userId)
    {
        $dbcon= new DbConnect();
        $db = $dbcon->connect();
        $userids = array();
        $userids[] = $userId;
        //Then we find all the user ids of subscribed users
        $sql = "SELECT user_sub_id FROM subscriptions WHERE user_id = ".$userId;

        $result = $db->query($sql);
        while($row = $result->fetch_object()) {
            $userids[] = $row->user_sub_id;
        }


        $sql = "select * from messages WHERE user_id IN (" . implode(', ',$userids) .")";


        $result2 = $db->query($sql);
        $messages = array();

        while($row = $result2->fetch_object()) {



            $messages[] = array('user' => $row->user_id, 'message'=> $row->id,'date'=> $row->created_at);
        }
        array_multisort( array_column($messages, "date"), SORT_DESC, $messages );
        print_r($messages);
        //TODO Add formatting

    }
}