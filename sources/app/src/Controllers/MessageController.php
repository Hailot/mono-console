<?php


namespace Mono\Controllers;


use Mono\Models\Message;
use Mono\Models\User;
use mysqli;

class MessageController
{
    private $user;

    /**
     * MessageController constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param string $messageString
     */
    public function postMessage(mysqli $db,string $messageString)
    {
        $message = new Message();
        $message->set_message($messageString);
        $message->set_user_id($this->user->get_id());
        $message->create($db);
    }
}