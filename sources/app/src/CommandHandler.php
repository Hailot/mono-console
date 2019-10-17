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

        //Command to exit application
        if($this->inputString === 'exit'){
            exit('Exit Application !!');
        }

        /*
         * Get Username from inputstring ,
         * We Assume A username does not contain spaces
         * Finally if variable is empty after search(substr),
         * we assume full string to be username
         */

        $userName = Utils::before(' ',$this->inputString);
        if(empty($userName)){
            $userName = $this->inputString;
        }

        //$command = Utils::before(' ', Utils::after($userName.' ',$this->inputString));
        $command = Utils::after($userName.' ',$this->inputString);
        if(empty($command)){
            $command = 'read';
        }

        $attribute = Utils::after($command." ",$this->inputString);

        /*
         * We now have the username
         * Therefor we can retrieve the user trough the usercontroller
         */
        $userController = new UserController();
        $user = $userController->getUserFromName($userName);


        /*
         * if none of the above is true
         * We know that the second entry in the array are the desired command
         */

        switch($command){
            //Command: Display Wall
            case "read":
                $userController->getWall($user->get_id());
                break;
            //Command: Create Message
            case "->":
                //call message controller
                $messageController = new MessageController($user);
                //We know that the third entry in the array will contain the message string so we pass that to the method
                $messageController->postMessage($attribute);
                break;
            //Command: Subscribe to a user
            case "follows":
                $subscriptionController = new SubscriptionController($user);
                $subscriptionController->subscribeToUser($attribute);
                break;
            //Command: get wall with subscriptions
            case "wall":
                $userController->getWallWithSubscriptions($user->get_id());
                break;


        }





    }


}