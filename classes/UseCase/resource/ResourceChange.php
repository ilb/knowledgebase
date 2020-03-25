<?php

/*
 * При редактировании рессурса
 */

namespace usecase\resource;

class ResourceChange {
    
    /**
     * @var string
     */
    private $nameResource;
    
    /**
     * @param string $nameResource
     */
    public function __construct($nameResource) {
        $this->nameResource = $nameResource;
    }
    
    /**
     * Изменения и уведомление пользователей
     */
    public function execute() {
        
    }
    
}
