<?php


namespace usecase\subscriptions;


use usecase\helper\UseCase;

class SubscribtionViewed extends UseCase {

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
        return $this->repository->setSubscriptionIsView($this->login, $this->material_name);
    }

}