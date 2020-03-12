<?php

namespace elements;


class Document extends Element {
    /**
     * источник данных документа
     * @var String
     */
    private $source;
    
    /**
     * Массив ресурсов
     * @var array \elements\Resource()
     */
    private $resources = [];
    
    /**
     *
     * @var string Уникальный идентификатор
     */
    private $idDoc;
    
    /**
     * Ключевые слова для поиска
     * @var array string
     */
    private $keywords = array();
    
    /**
     *  наименовение документа
     * @var string
     */
    private $nameDocument;
    
    /**
     * 
     * @param string $nameDocument
     * @param string $source
     */
    public function __construct($nameDocument, $source) {
        $this->nameDocument = $nameDocument;
        $this->source = $source;
    }
    
    /**
     *  Меняет имя у документа и вызывает класс ElementObserver
     * @param string $newNameDocument
     */
    public function setNameDocument($newNameDocument) {
        $this->nameDocument = $newNameDocument;
        $this->notify();
    }
    
    /**
     * Возвращает все привязанные ключевые слова
     * @return array string
     */
    public function getKeyWords() {
        return $this->keywords;
    }

    /**
     *  Добавляет ключевое слово и уведомляет пользователя
     * @param string $keyWord
     */
    public function addKeyWord($keyWord) {
        $this->keywords[] = strtolower($keyWord);
        $this->notify();
    }
    
    /**
     * Добавляет массив ключевых слов
     * @param array $keyWords
     */
    public function addKeyWords($keyWords) {
        foreach ($keyWords as $keyWord) {
            $this->keywords[] = strtolower($keyWord);   
        }        
        $this->notify();
    }
    
    /**
     * 
     * @return string
     */
    public function getIdDoc() {
        return $this->idDoc;
    }

    /**
     * 
     * @return string
     */
    public function getUnicalName() {
        return $this->idDoc;
    }
    
    /**
     * По заданному $this->source парсит страницу 
     */
    public function createResources() {
        $resourceAdapter = new \adapter\ResourceAdapter();
        $rawResources = $resourceAdapter->getResource($this->source);
        foreach ($rawResources as $rawResource) {
            $this->resources[] = new Resource($rawResource['name'], $rawResource['source']);
        }
    }
    
    /**
     * 
     * @return array \elements\Resource()
     */
    public function getResources() {
        return $this->resources;
    }
    
    /**
     * 
     * @param string $tagResource
     * @return \elements\Resource
     */
    public function getResourceByTag($tagResource) {
        foreach ($this->resources as $resource) {
            if ($resource->getTag() == $tagResource) {
                return resource;
            }
        }
    }
}
