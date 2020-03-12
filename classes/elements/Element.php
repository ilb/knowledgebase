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
        return $this->observer->execute($this, "", "event");
    }
    
    /**
     * При изменении контента документа
     */
    public function changeContent() {
        return $this->notify();
    }
    
    /**
     * Устанавливает наблюдателя
     * @param \observer\ElementObserver $observer
     */
    public function setObserver($observer) {
        $this->observer = $observer;
    }
    
    /**
     * Удаляет наблюдателя
     */
    public function deleteObserver() {
        $this->observer = null;
    }
    
}