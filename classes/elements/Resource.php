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
     * @var string
     */
    private $nameResource;

    /**
     * 
     * @param string $tag
     */
    public function __construct($name, $tag) {
        $this->nameResource = $name;
        $this->tag = $tag;
    }
    
    /**
     * 
     * @param string $name
     */
    public function setName($name) {
        $this->nameResource = $name;
        $this->notify();
    }


    /**
     * Получает уникальное имя ресурса
     * @return string
     */
    public function getUnicalName() {
        return $this->tag;
    }
    
    /**
     * Возращает тег ресурса
     * @return string
     */
    public function getTag() {
        return $this->tag;
    }
}
