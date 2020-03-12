<?php

namespace elements;

class Catalog {
    /**
     *
     * @var array \elements\Document()
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
    
    /**
     * Создает через адаптер документы
     */
    public function createDocuments() {
        $adapter = new \adapter\DocumentAdapter();
        $rawDocuments = $adapter->getDocuments($this->source);
        foreach ($rawDocuments as $rawDocument) {
            $this->docs[] = new \elements\Document($rawDocument['name'], $rawDocument['source']);
        }
    }
    
    /**
     * 
     * @return array \elements\Document()
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
     * Находит документы и ресурсы содержащие в себе искомое значение
     * Возвращает двумерный массив с ключами document и resource 
     * Где в первом содержаться все найденные документы 
     * А во стором все найденные ресурсы
     * @param string $word
     * @return array
     */
    public function searchElement($word) {
        $result = array();
        foreach ($this->docs as $doc) {
            if (in_array(strtolower($word), $doc->getKeyWords())) {
                $result['document'][] = $doc;
                continue;
            }
            foreach ($doc->getResources() as $resource) {
                if (strtolower($word) == $resource->getTag()) {
                    $result['resource'][] = $resource;
                    continue;
                }
            }
        }
        return $result;
    }
} 
