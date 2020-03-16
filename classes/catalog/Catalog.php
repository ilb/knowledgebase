<?php

namespace catalog;

class Catalog {
    /**
     *
     * @var array \material\Document
     */
    private $docs = array();
    
    /**
     * Главная страница откуда создаются документы
     * Источник информации как и в самих документах
     * ссылка как и у документов
     * @var string 
     */
    private $source;
    
    /**
     * 
     * @param string $source
     */
    public function __construct($source) {
        $this->source = $source;
    }
    
    /**
     * Создает через адаптер документы
     */
    public function createDocuments() {
        $parser = new \parser\DocumentParser();
        $rawDocuments = $parser->getDocuments($this->source);
        foreach ($rawDocuments as $rawDocument) {
            $this->docs[] = new \material\Document($rawDocument['name'], $rawDocument['source']);
        }
    }
    
    /**
     * 
     * @return array \elements\Document
     */
    public function getDocuments() {
        return $this->docs;
    }
    
    /**
     * 
     * @param string $idDocument
     * @return \elements\Document
     */
    public function getDocumentById($idDocument) {
        foreach ($this->docs as $doc) {
            if ($doc->getIdDoc() == $idDocument) {
                return $doc;
            }
        }
    }
    
    /**
     * Находит документы содержащие в себе искомое значение
     * @param string $word
     * @return array
     */
    public function searchMaterials($word) {
        $result = array();
        foreach ($this->docs as $doc) {
            if (in_array(strtolower($word), $doc->getKeyWords())) {
                $result[] = [ "document" => $doc, "findName" => $doc->getName() . "#" . $word];
                continue;
            }
        }
        return $result;
    }
} 
