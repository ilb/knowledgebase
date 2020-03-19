<?php

namespace user;

class Mentor extends User {
    
    /**
     * @var \controller\MentorController
     */
    private $mentorController;
    
    /**
     * @var string
     */
    private $login;
    
    /**
     * 
     * @param \controller\MentorController $controller
     */
    public function setController($controller) {
        $this->mentorController = $controller;
    }
    
    /**
     * Подписать пользователя
     * @param string $nameElement
     * @param \user\User $user
     */
    public function subscribeUser($nameElement, $user) {
        $this->adminController->addSubscribtion($nameElement, $user);
    }
    
    /**
     * Отчет о всех подписках пользователей
     */
    public function getReportSubscription() {
        $this->adminController->getReportSubscribtions();
    }
}