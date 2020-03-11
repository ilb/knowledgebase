<?php

namespace elements;

abstract class Element {
    /**
     *
     * @var ElementObserver
     */
    protected $observer;
    
    /**
     * Задействет класс наблюдателя
     */
    public function notify() {
        return $this->observer->execute($this, "");
    }
    
    /**
     * При изменении контента документа
     */
    public function changeContent() {
        return $this->notify();
    }
    
}