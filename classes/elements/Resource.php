<?php

namespace elements;

class Resource extends Element {
    private $tag;
    
    public function __construct($tag) {
        $this->tag = $tag;
    }
    
    public function getUnicalName() {
        return $this->tag;
    }
    
}
