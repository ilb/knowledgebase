<?php

/* 
 * Изменение документа
 */

namespace usecase;

class DocumentChange {
    
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
     */
    public function __construct($nameDocument, $source) {
        $this->nameDocument = $nameDocument;
        $this->source = $source;
    }
    
    public function executу() {
        $catalog = new \catalog\Catalog($this->source);
        $catalog->createDocuments();
        $doc = $catalog->getDocumentByName($this->nameDocument);
        $doc->editDocument("");
    }
}
