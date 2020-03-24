<?php

/* 
 * Удаление документа
 */

namespace usecase;

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
        $catalog = new \catalog\Catalog($this->source);
        $catalog->createDocuments();
        $catalog->deleteDocument($this->nameDcoument);
    }
}