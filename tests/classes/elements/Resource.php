<?php

namespace elements;

class Resource extends Element {
    private $tag;
    
    public function __construct($tag, $s) {
        $this->tag = $tag;
        $this->observer = new \observer\ElementObserver($s);
    }
    
    public function getUnicalName() {
        return $this->tag;
    }
    
}
