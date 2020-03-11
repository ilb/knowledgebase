<?php

namespace user;

class User {
    private $login;
    
    public function __construct($login) {
        $this->login = $login;
    }
    public function getLogin() {
        return $this->login;
    }
}
