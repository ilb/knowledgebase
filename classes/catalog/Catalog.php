<?php

namespace catalog;

class Catalog {
    
    /**
     * @var array \document\Document
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
     * @param string $source
     */
    public function __construct($source) {
        $this->source = $source;
    }
    
    /**
     * Создает через парсер документы
     */
    public function createDocuments() {
        $parser = new \parser\DocumentParser();
        $rawDocuments = $parser->getDocuments($this->source);
        foreach ($rawDocuments as $rawDocument) {
            $this->docs[] = new \document\Document($rawDocument['name'], $rawDocument['source']);
        }
    }
    
    /**
     * 
     * @return array \document\Document
     */
    public function getDocuments() {
        return $this->docs;
    }
    
    /**
     * 
     * @param string $idDocument
     * @return \document\Document
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
        $word = strtolower($word);
        foreach ($this->docs as $doc) {
            if (preg_filter("/.*[" . $word . "].*/", "", $doc->getKeyWords())) {
                // Тег не всегда будет являться тегом ресурса                    ↓
                $result[] = [ "document" => $doc, "link" => $doc->getSource() . "#" . $word];
            }
        }
        return $result;
    }
} 
