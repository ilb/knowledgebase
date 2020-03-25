<?php

/**
 * для получения списка документов
 */

namespace usecase\document;

class DocumentList {
    
    /**
     * @var type 
     */
    private $source;

    /**
     * @param stirng $source
     */
    public function __construct($source) {
        $this->source = $source;
    }

    /**
     * @return array<\document\Document>
     */
    public function execute() {
        $catalog  = new \catalog\Catalog($this->source);
        $catalog->createDocuments();
        return $catalog->getDocuments();
    }
    
}