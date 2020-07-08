<?php

/* 
 * Изменение документа
 */

namespace usecase\document;

use catalog\Catalog;
use observer\ObserverImpl;
use usecase\helper\UseCase;

class DocumentChange extends UseCase  {
    
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
    
    /**
     * Приходит уведомление о изменении объекта
     */
    public function execute() {
//        $catalog = new Catalog($this->source);
//        $catalog->createDocuments();
//        $subs = $this->repository->getSubscribtions();
//        $observer = new ObserverImpl();
//        $observer->setSubscriptions($subs);
//        foreach ($catalog->getDocuments() as $doc) {
//            $doc->setObserver($observer);
//            $doc = $catalog->getDocumentByName($this->nameDocument);
//            $doc->editDocument("");
//        }
    }
}
