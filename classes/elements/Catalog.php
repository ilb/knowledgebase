<?php

namespace elements;

class Catalog {
    /**
     *
     * @var array \elements\Document()
     */
    private $docs = array();
    
    /**
     * Редактирование документа
     * @param string $idDoc 
     */
    public function editDoc($idDoc) {
        foreach ($this->docs as $doc) {
           if ($doc->getIdDoc() == $idDoc) {
               $doc->changeContent();
           }
        }
    }
} 
