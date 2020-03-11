<?php

namespace elements;

class Catalog {
    private $docs = array();
    
    public function __construct($s) {
        for ($i = 0; $i < 5; $i++) {
            if ($i % 2 == 0) {
                $this->docs[]  = new Document("Doc_" . $i, $s);
            } 
        }
    }
    
    public function editDoc($idDoc) {
        foreach ($this->docs as $doc) {
           if ($doc->getIdDoc() == $idDoc) {
               return $doc->changeContent();
           }
        }
    }
    
    public function editResource($idDoc) {
        foreach ($this->docs as $doc) {
           if ($doc->getIdDoc() == $idDoc) {
               return $doc->getResources()[0]->changeContent();
           }
        }
    }
} 
