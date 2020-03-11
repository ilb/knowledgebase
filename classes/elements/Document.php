<?php

namespace elements;


class Document extends Element {
    private $source;
    private $resources = [];
    private $idDoc;
    private $keywords = array();
    private $nameDocument;
    
    public function __construct($idDoc) {
        $this->idDoc = $idDoc;
    }
    
    public function setNameDocument($newNameDocument) {
        $this->nameDocument = $newNameDocument;
        $this->notify();
    }

    private function addKeyWord($keyWord) {
        $this->keywords[] = $keyWord;
        $this->notify();
    }
    
    public function getIdDoc() {
        return $this->idDoc;
    }

    public function getUnicalName() {
        return $this->idDoc;
    }
}
