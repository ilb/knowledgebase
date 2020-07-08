<?php

/*
 * При редактировании рессурса
 */

namespace usecase\resource;

use usecase\helper\UseCase;

// Меняет ссылку на ресуср\документ
class ResourceChange extends UseCase {
    
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
