<?php


namespace usecase\subscriptions;


class SubscribtionViewed {

    /**
     * логин пользователя
     * @var string
     */
    private $login;

    /**
     * Имя подписки
     * @var string
     */
    private $material_name;

    /**
     * @param string $login
     * @param string $material_name
     */
    public function __construct($login, $material_name) {
        $this->login = $login;
        $this->material_name = $material_name;
    }

    public function execute() {
        $repo = new \repository\Repository();
        return $repo->subscriptionIsView($this->login, $this->material_name);
    }

}