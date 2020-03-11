<?php

namespace elements;

class Catalog {
    private $docs = array();
    
    public function __construct() {
        
    }
    
    public function editDoc($idDoc) {
        foreach ($this->docs as $doc) {
           if ($doc->getIdDoc() == $idDoc) {
               return $doc->changeContent();
           }
        }
    }
} 
