<?php

/*
 * Назначение пользователя ментором
 */

namespace usecase\admin;

use usecase\helper\UseCase;

class SetMentor extends UseCase  {
    
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
