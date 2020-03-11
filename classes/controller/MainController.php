<?php

class MainController {
    /**
     *
     * @var \subscription\Subscriptions
     */
    private $subscriptions;
    
    /**
     *
     * @var \observer\ElementObserver
     */
    private $observer;
    
    /**
     *
     * @var \elements\Catalog
     */
    private $catalog;
    
    /**
     * Создает $this->subscriptions по классу \subscription\Subscriptions
     */
    public function createSubscriptions() {
        
    }
    
    /**
     * Создает $this->observer по классу \observer\ElementObserver
     */
    public function createObserver() {
        $this->observer = new \observer\ElementObserver();
    }
    
    /**
     * Создает $this->catalog по классу \elements\Catalog
     */
    public function createCatalog() {
        $this->catalog = new \elements\Catalog();
    }
}
