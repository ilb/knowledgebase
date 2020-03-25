<?php

/*
 * Назначение пользователя ментором
 */

namespace usecase\admin;

class SetMentor {
    
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
   
    public function execute() {
        
    }
    
}
