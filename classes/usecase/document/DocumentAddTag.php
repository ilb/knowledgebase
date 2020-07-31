<?php

/*
 * Добавление тега к документу
 */
namespace usecase\document;

use usecase\helper\UseCase;

class DocumentAddTag extends UseCase  {
    
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
        return $this->repository->addkeyword($this->documentName, $this->newKeyWord);
    }
}
