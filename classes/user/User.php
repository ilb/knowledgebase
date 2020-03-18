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
}
