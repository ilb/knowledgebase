<?php

/* 
 * Изменение документа
 */

namespace usecase\document;

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
    
    /**
     * Приходит уведомление о изменении объекта
     */
    public function execute() {
        $catalog = new \catalog\Catalog($this->source);
        $catalog->createDocuments();
        $subs = new \repository\Repository();
        $observer = new \observer\ObserverImpl();
        $observer->setSubscriptions($subs);
        $doc->setObserver($observer);
        $doc = $catalog->getDocumentByName($this->nameDocument);
        $doc->editDocument("");
    }
}
