<?php

/* 
 * Удаление документа
 */

namespace usecase\document;

use config\Config;
use usecase\helper\UseCase;

class DocumentDelete extends UseCase  {
    
    /**
     * @var string
     */
    private $nameDcoument;
    
    /**
     * @param string $nameDocument
     */
    public function __construct($nameDocument) {
        $this->nameDcoument = $nameDocument;
    }
    
    
    public function execute() {
        $this->repository->deleteDocument($this->nameDcoument);
        $filePath = Config::getInstance()->filespath . "/" . $this->nameDcoument;
        if (file_exists($filePath)) {
            return unlink($filePath);
        }
        return true;
    }
}