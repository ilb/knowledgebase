<?php

/**
 * для получения списка документов
 */

namespace usecase\catalog;

use catalog\Catalog;
use response\Response;
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
     * @return Response
     */
    public function execute() {
        $catalog  = new Catalog($this->source);
        $catalog->createDocuments();
        foreach ($catalog->getDocuments() as $document) {
            $document->createResources();
        }
        return new Response($catalog);
    }
    
}