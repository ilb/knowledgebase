<?php

namespace subscription;

class Subscription {
    private $element;
    private $user;
    
    public function getElement() {
        return $this->element;
    }
    
    public function getUser() {
        return $this->user;
    }
    public function __construct($user, $element) {
        $this->user = $user;
        $this->element = $element;
    } 

}

