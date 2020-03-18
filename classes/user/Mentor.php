<?php

namespace user;

class Mentor {
    
    /**
     * @var \controller\MentorController
     */
    private $mentorController;
    
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