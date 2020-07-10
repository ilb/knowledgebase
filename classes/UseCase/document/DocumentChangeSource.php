<?php

/* 
 * Изменение документа
 */

namespace usecase\document;

use catalog\Catalog;
use usecase\helper\UseCase;

// Изменяет ресурс на который ссылается документ
class DocumentChangeSource extends UseCase  {
    
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


    public function execute() {
//        $doc = $catalog->getDocumentByName($nameDocument);
//        $doc->setSource($newSource);
    }
}
