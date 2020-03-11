<?php

namespace elements;

class Resource extends Element {
    /**
     *
     * @var string
     */
    private $tag;
    
    /**
     * 
     * @param string $tag
     */
    public function __construct($tag) {
        $this->tag = $tag;
    }
    
    /**
     * Получает уникальное имя класса
     * @return string
     */
    public function getUnicalName() {
        return $this->tag;
    }
    
}
