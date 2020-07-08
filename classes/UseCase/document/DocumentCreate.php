<?php

/* 
 * Создание документа
 */

namespace usecase\document;

use usecase\helper\UseCase;

class DocumentCreate extends UseCase  {
    
    /**
     * @var string
     */
    private $nameDocument;
    
    /**
     * @var string
     */
    private $source;
    
    /**
     * @param string $nameDocument
     * @param string $source
     */
    public function __construct($nameDocument, $source) {
        $this->nameDocument = $nameDocument;
        $this->source = $source;
    }
    
    public function execute() {
        $this->repository->addDocument($this->nameDocument, $this->source);
    }

}

