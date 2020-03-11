<?php

namespace elements;


class Document extends Element {
    private $source;
    private $resources = [];
    private $idDoc;
    private $keywords = array();
    private $nameDocument;
    
    public function __construct($idDoc, $s) {
        $this->idDoc = $idDoc;        
        $this->observer = new \observer\ElementObserver($s);
        for ($i = 0; $i < 5; $i++) {
            if ($i % 2 != 0) {
                $this->resources[] = new Resource("Res_" . $i, $s);
            } 
        }
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
