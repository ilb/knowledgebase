<?php

/**
 * для получения списка документов
 */

namespace usecase\catalog;

use catalog\Catalog;
use usecase\helper\UseCase;

class GetCatalog extends UseCase {
    
    /**
     * @var string
     */
    private $source;

    /**
     * @param string $source
     */
    public function __construct($source) {
        $this->source = $source;
    }

    /**
     * @return Catalog
     */
    public function execute() {
        $catalog  = new Catalog($this->source);
        $catalog->createDocuments();
        return $catalog;
    }
    
}