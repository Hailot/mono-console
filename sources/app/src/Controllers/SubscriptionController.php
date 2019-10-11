<?php


namespace Mono\Controllers;


use Mono\Models\Message;
use Mono\Models\Subscription;
use Mono\Models\User;

class SubscriptionController
{
    private $user;

    /**
     * SubscriptionController constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function subscribeToUser(string $subscribedUsersname)
    {
        //We Start by getting the user we wish to subscribe to
        $subscribedUser = new User();
        $subscribedUser->loadFromName($subscribedUsersname);

        //We then create the subscription
        $subscription = new Subscription();
        $subscription->set_user_id($this->user->get_id());
        $subscription->set_user_sub_id($subscribedUser->get_id());
        $subscription->create();

        //Finally we create a message for the that we now follow that user
        $message = new Message();
        $message->set_user_id($this->user->get_id());
        $message->set_message($this->user->get_name().' now follows '.$subscribedUser->get_name());
        $message->create();
    }
}