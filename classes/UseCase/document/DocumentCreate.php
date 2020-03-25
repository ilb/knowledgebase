<?php

/* 
 * Создание документа
 */

namespace usecase\document;

class DocumentCreate {
    
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
        $repos = new \repository\Repository();
        $repos->addDocument();
    }

}

