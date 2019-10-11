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

        $userName = Utils::before(' ',$this->inputString);
        if(empty($userName)){
            $userName = $this->inputString;
        }

        $command = Utils::before(' ', Utils::after($userName.' ',$this->inputString));

        $attribute = Utils::after($command." ",$this->inputString);



        require_once __DIR__ . '/../vendor/autoload.php';

        require_once ('db.info.php');

        $db = new mysqli ( DB_HOST, DB_USER, DB_PASS, DB_BASE );


        if($db->connect_error){
            die("Connection failed: " . $db->connect_error);

        }


        /*
         * We now have the username
         * Therefor we can retrieve the user trough the usercontroller
         */
        $userController = new UserController();
        $user = $userController->getUserFromName($db,$userName);



        /*
         * if none of the above is true
         * We know that the second entry in the array are the desired command
         */

        switch($command){
            //Command: Display Wall
            case '':
                $userController->getWall($db,$user->get_id());
                break;
            //Command: Create Message
            case "->":
                //call message controller
                $messageController = new MessageController($user);
                //We know that the third entry in the array will contain the message string so we pass that to the method
                $messageController->postMessage($db,$attribute);
                break;
            //Command: Subscribe to a user
            case "follows":
                $subscriptionController = new SubscriptionController($user);
                $subscriptionController->subscribeToUser($db,$attribute);
                break;
            //Command: get wall with subscriptions
            case "wall":
                $userController->getWallWithSubscriptions();
                break;

            case "exit":
                exit('Exit Application !!');


        }





    }


}