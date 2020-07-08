<?php

/**
 * Поиск по документам тут
 */

namespace usecase\document;

use catalog\Catalog;
use usecase\helper\UseCase;

class DocumentSearch extends UseCase  {
    
    /**
     * @var string
     */
    private $source;
    
    /**
     * @var string
     */
    private $keyWord;
    
    /**
     * @param string $source
     * @param string $keyWord
     */
    public function __construct($source, $keyWord) {
        $this->source = $source;
        $this->keyWord = $keyWord;
    }
    
    /**
     * ВОзвращает массив найденных ресурсов и ссылки на них
     * @return array<array<Resource>>
     */
    public function execute() {
        $catalog = new Catalog($this->source);
        $catalog->createDocuments();
        foreach ($catalog->getDocuments() as $doc) {
            $doc->createResources();
        }        
        return $catalog->searchByKeyword($this->keyWord);
    }
}
