<?php

namespace user;

class User {
    
    /**
     * @var string
     */
    private $login;
    
    /**
     * @var \controller\AdminController
     */
    protected $controller;
    
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
     * @param \controller\AdminController $controller
     */
    public function setController($controller) {
        $this->controller = $controller;
    }
    
    /**
     * 
     * @param string $word
     */
    public function search($word) {
        return $this->controller->searchDocument($word);
    }
    
    /**
     * Просмотр всех материалов на которые его подписали
     */
    public function viewSubscriptions() {
        return $this->controller->viewSubscription($this);
    }
    
    /**
     * @param string $link
     */
    public function addOffer($link) {
        $this->controller->addOffer($this, $link);
    }
    
    /**
     * Просмотр не прочитанных подписок
     */
    public function viewSubscriptionDontRead() {
        $this->controller->viewDontReadSubsc($this);
    }
}
