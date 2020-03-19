<?php

namespace user;

class User {
    
    /**
     * @var string
     */
    private $login;
    
    /**
     * @var \conntroller\UserController
     */
    private $userController;
    
    /**
     * @param string $login
     */
    public function __construct($login) {
        $this->login = $login;
    }
    
    /**
     * @return string
     */
    public function getLogin() {
        return $this->login;
    }
    
    /**
     * @param \controller\UserController $controller
     */
    public function setController($controller) {
        $this->userController = $controller;
    }
    
    /**
     * 
     * @param string $word
     */
    public function search($word) {
        $this->userController->searchDocument($word);
    }
    
    /**
     * Просмотр всех материалов на которые его подписали
     */
    public function viewSubscriptions() {
        $this->userController->viewSubscription($this);
    }
    
    /**
     * @param string $link
     */
    public function addOffer($link) {
        $this->userController->addOffer($this, $link);
    }
    
    /**
     * Просмотр не прочитанных подписок
     */
    public function viewSubscriptionDontRead() {
        $this->userController->viewDontReadSubsc($this);
    }
}
