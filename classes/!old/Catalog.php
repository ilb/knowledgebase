<?php

class Catalog {
    /**
     *
     * @var Array Class Document object
     */
    private $documents = array();
    
    /**
     * создает массив классов Document
     */
    public function getDocuments() {
        $adapter = new Adapter("../index.html");
        $arrayDocs = $adapter->getDocs();
        foreach ($arrayDocs as $val) {
            $this->createDocument($val['name'], $val['href']);
        }
    }
    
    /**
     * редактирование документа по id
     * @param string $id
     */
    public function editDocumebt($id) {
        //search to $id method
    }
    
    /**
     * 
     * @param string $id
     * @param string $source
     */
    public function createDocument($id, $source) {
        $this->documents[] = new Document($id, $source);
    }
    
    /**
     * 
     * @param string $id
     */
    public function viewDocument($id) {
        //search to $id method
    }
    
}
