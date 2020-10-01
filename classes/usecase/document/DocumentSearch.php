<?php

/**
 * Поиск по документам тут
 */

namespace usecase\document;

use catalog\Catalog;
use response\Response;
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
     * @return \response\Response
     */
    public function execute() {
        $catalog = new Catalog($this->source);
        $catalog->createDocuments();
        // Если получать из репозитория то цикл можно убрать
        foreach ($catalog->getDocuments() as $doc) {
            $doc->createResources();
            $doc->getName();

            $keywords = $this->repository->getKeywords($doc->getName());
            $doc->addKeywords($keywords);
        }
        $res = $catalog->searchByKeyword($this->keyWord);
        return new Response($res);
    }
}