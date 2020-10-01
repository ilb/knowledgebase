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
     * @param string $nameDocument
     * @param string $source
     */
    public function __construct($nameDocument) {
        $this->nameDocument = $nameDocument;
    }
    
    public function execute() {
        $this->repository->addDocument($this->nameDocument);
    }

}

