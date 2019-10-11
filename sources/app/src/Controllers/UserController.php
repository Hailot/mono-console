<?php


namespace Mono\Controllers;


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

    public function getUserFromName(mysqli $db,$name)
    {
        $user = new User();
        $user->loadFromName($db,$name);
        return $user;
    }

    public function getWall(mysqli $db,$userId)
    {
        $sql = "select id from messages WHERE user_id = " . $userId;

        $result = $db->query($sql);
        $messages = array();

        while($row = $result->fetch_object()) {

           $message = new Message();
           $message->load($db,$row->id);

            $messages[] = $message;
        }


        /** @var Message $message */
        $now = new \DateTime();
        foreach ($messages as $message){
            echo $message->get_message()." (".$message->get_time_elapsed_string().") \n";
        }
    }

    public function getWallWithSubscriptions(mysqli $db, $userId)
    {
        $userids = array();
        $userids[] = $userId;
        //Then we find all the user ids of subscribed users
        $sql = "SELECT user_sub_id FROM subscriptions WHERE user_id = ".$userId;

        $result = $db->query($sql);
        while($row = $result->fetch_object()) {
            $userids[] = $row->user_sub_id;
        }


        $sql = "select * from messages WHERE user_id IN " . $userids;

        $result = $db->query($sql);
        $messages = array();

        while($row = $result->fetch_object()) {



            $messages[] = array('user' => $row->user_id, 'message'=> $row->id,'date'=> $row->created_at);
        }
        $sortedMessages = array_multisort( array_column($messages, "date"), SORT_DESC, $messages );

    }
}