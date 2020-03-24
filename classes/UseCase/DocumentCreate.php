<?php

/* 
 * Создание документа
 */

namespace usecase;

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
        $catalog = new \catalog\Catalog("");
        $catalog->createDocument($this->nameDocument, $this->source);
    }

}

