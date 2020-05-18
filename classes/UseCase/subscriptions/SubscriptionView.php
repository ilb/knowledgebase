<?php

namespace usecase\subscriptions;

class SubscriptionView
{

    /**
     * Логин пользователя
     * @var string
     */
    private $login;

    /**
     * @param $user string
     */
    public function __construct($login)
    {
        $this->login = $login;
    }

    /**
     * Показывает все подписки пользователя
     * @return \subscription\Subscriptions
     */
    public function execute()
    {
        $repo = new \repository\Repository();
        $subs = $repo->getSubscribtionsByUser($this->login);
        $subscriptions = new \subscription\Subscriptions();
        $user = new \user\User($this->login);
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
        return $subscriptions;
    }
}
