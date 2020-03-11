<?php

class Users {
    /**
     *
     * @var String 
     */
    private $login;
    
    /**
     * 
     * @param String $login
     */
    public function __construct($login) {
        $this->login = $login;
    }

}

