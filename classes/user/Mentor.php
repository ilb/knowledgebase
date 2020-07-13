<?php

namespace user;

class Mentor extends User {
    
    /**
     * @var string
     */
    private $login;
    
    /**
     * Подписать пользователя
     * @param string $nameElement
     * @param \user\User $user
     */
    public function subscribeUser($nameElement, $user) {
        $this->controller->addSubscribtion($nameElement, $user);
    }
    
    /**
     * Отчет о всех подписках пользователей
     */
    public function getReportSubscription() {
        return $this->controller->getReportSubscribtions();
    }
}