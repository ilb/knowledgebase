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
            if (preg_match_all("/[#]/", $name)) {
                $name = "#" . explode("#", $name)[1];
            }
            $subscriptions->subscribe($name, $user);
            if ($value['is_read']) {
                $subscriptions->getSubscriptionsByUserElement($user, $name)->setIsRead(1);
            }
        }
        return new Response($subscriptions);
    }
}
