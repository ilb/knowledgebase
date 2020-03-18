<?php

namespace user;

class Admin {
    
    /**
     * @var \controller\AdminController 
     */
    private $adminController;
    
    /**
     * @var string
     */
    private $login;
    
    /**
     * @param string $login
     */
    public function __construct($login) {
        $this->login = $login;
    }
    
}