<?php

/*
 * Добавление тега к документу
 */
namespace usecase\document;

class DocumentAddTag {
    
    /**
     * @var string
     */
    private $documentName;
    
    /**
     * @var string
     */
    private $newKeyWord;
    
    /**
     * @param string $documentName
     * @param string $newKeyWord
     */
    public function __construct($documentName, $newKeyWord) {
        $this->documentName = $documentName;
        $this->newKeyWord = $newKeyWord;
    }
    
    public function execute() {
        $repo = new \repository\Repository();
    }
}
