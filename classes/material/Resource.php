<?php

namespace material;

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
     * @var \observer\ObserverImpl
     */
    private $observer;
    
    /**
     * 
     * @param string $tag
     */
    public function __construct($name, $tag) {
        $this->nameResource = $name;
        $this->tag = $tag;
    }
    
    /**
     * Для уведомления наблюдателя 
     */
    public function notify() {
        $this->observer->execute("#" . $this->tag, "Текст уведомления", "event");
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
     * 
     * @return string
     */
    public function getName() {
        return $this->tag;
    }
    
    /**
     * Возращает тег ресурса
     * @return string
     */
    public function getTag() {
        return $this->tag;
    }
    
    /**
     * Редактирование ресурса
     */
    public function editResource($content) {
        
        $this->notify();
    }
    
}
