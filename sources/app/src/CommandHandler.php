<?php


namespace Mono;


use Mono\Controllers\MessageController;
use Mono\Controllers\SubscriptionController;
use Mono\Controllers\UserController;
use mysqli;

class CommandHandler
{
    public $inputString;
    public function __construct($inputString)
    {
        $this->inputString = $inputString;
    }

    //This function converts user input to commands
    public function handle(){
        $splitter = " ";
        $pieces = explode($splitter, $this->inputString);
        require_once __DIR__ . '/../vendor/autoload.php';

        require_once ('db.info.php');

        $db = new mysqli ( DB_HOST, DB_USER, DB_PASS, DB_BASE );


        if($db->connect_error){
            die("Connection failed: " . $db->connect_error);

        }

        //Command - Exit Application
        if ($pieces[0] == 'exit')
        {
            exit('Exit Application !!');
        }

        /*
         * We know that the first entry in the array will be the username
         * Therefor we can retrieve the user trough the usercontroller
         */
        $userController = new UserController();
        $user = $userController->getUserFromName($db,$pieces[0]);

        /*
         * If the array only contains 1 entry we know the desired command is read a users wall
         */
        if(count($pieces) == 1){
            $userController->getWall($db,$user->get_id());
        }

        /*
         * if none of the above is true
         * We know that the second entry in the array are the desired command
         */

        switch($pieces[1]){
            //Command: Create Message
            case "->":
                //call message controller
                $messageController = new MessageController($user);
                //We know that the third entry in the array will contain the message string so we pass that to the method
                $messageController->postMessage($db,$pieces[2]);
                break;
            //Command: Subscribe to a user
            case "follows":
                $subscriptionController = new SubscriptionController($user);
                $subscriptionController->subscribeToUser($db,$pieces[2]);
                break;
            //Command: get wall with subscriptions
            case "wall":
                $userController->getWallWithSubscriptions();
                break;

        }





    }
}