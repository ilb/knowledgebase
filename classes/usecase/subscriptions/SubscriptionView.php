<?php

namespace usecase\subscriptions;

use response\Response;
use subscription\Subscriptions;
use usecase\helper\UseCase;
use user\User;

class SubscriptionView extends UseCase {

    /**
     * Логин пользователя
     * @var string
     */
    private $login;

    /**
     * @param $login
     */
    public function __construct($login) {
        $this->login = $login;
    }

    /**
     * Показывает все подписки пользователя
     */
    public function execute() {
        $subs = $this->repository->getSubscribtionsByUser($this->login);
        $subscriptions = new Subscriptions();
        $user = new User($this->login);
        foreach ($subs as $value) {
            $name = $value['name'];
            $parent = $value['name'];
            if (preg_match_all("/[#]/", $name)) {
                $parent = explode("#", $name)[0];
                $name = "#" . explode("#", $name)[1];
            }
            $sub = new \subscription\Subscription($user, $name);
            $sub->setParent($parent);
            $subscriptions->AddSubscription($sub);
            if ($value['is_read']) {
                $subscriptions->getSubscriptionsByUserElement($user, $name)->setIsRead(1);
            }
        }
        return new Response($subscriptions);
    }
}
