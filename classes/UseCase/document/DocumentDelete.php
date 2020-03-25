<?php

/* 
 * Удаление документа
 */

namespace usecase\document;

class DocumentDelete {
    
    /**
     * @var string
     */
    private $nameDcoument;
    
    /**
     * @var string
     */
    private $source;
    
    /**
     * @param string $nameDocument
     */
    public function __construct($nameDocument, $source) {
        $this->nameDcoument = $nameDocument;
        $this->source = $source;
    }
    
    
    public function execute() {
        $repos = new \repository\Repository();
        $repos->deleteDocument($this->nameDcoument);
    }
}