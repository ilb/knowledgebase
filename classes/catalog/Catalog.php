<?php

namespace catalog;

use document\Document;
use parser\DocumentParser;
use resource\Resources;

class Catalog {
    
    /**
     * @var array<\document\Document>
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
     * Создает новый документ
     * @param string $nameDocument
     * @param string $source
     */
    public function createDocument($nameDocument, $source) {
        $this->docs[] = new Document($nameDocument, $source);
    }
    
    /**
     * Создает через парсер документы
     */
    public function createDocuments() {
        $parser = new DocumentParser();
        $rawDocuments = $parser->getDocuments($this->source);
        foreach ($rawDocuments as $rawDocument) {
            $this->docs[] = new Document($rawDocument['name'], $rawDocument['source']);
        }
    }
    
    /**
     * 
     * @return array<\document\Document>
     */
    public function getDocuments() {
        return $this->docs;
    }
    
    /**
     * 
     * @param string $nameDocument
     * @return Document
     */
    public function getDocumentByName($nameDocument) {
        foreach ($this->docs as $doc) {
            if ($doc->getNameDocument() == $nameDocument) {
                return $doc;
            }
        }
        return null;
    }
    
    /**
     * Находит документы содержащие в себе искомое значение
     * @param string $word
     * @return \resource\Resources
     */
    public function searchByKeyword($word) {
        $result = new Resources();
        $word = strtolower($word);
        foreach ($this->docs as $doc) {
            if (in_array($word, $doc->getKeyWords())) {
                // Тег не всегда будет являться тегом ресурса                    ↓
                $result->addResource($doc->getName(),$doc->getSource(), $word);//[ "document" => $doc, "link" => $doc->getSource() . "#" . $word];
            }
        }
        return $result;
    }
    
    /**
     * Удаляет документ
     * @param string $nameDocument
     * @return boolean
     */
    public function deleteDocument($nameDocument) {
        foreach ($this->docs as $key => $document) {
            if ($document->getName() == $nameDocument) {
                unset($this->docs[$key]);

                return true;
            }
        }
        return false;
    }
    
} 
