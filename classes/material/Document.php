<?php

namespace material;


class Document {
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
     * @var \observer\ObserverImpl
     */
    private $observer;
   
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
     * Для уведомления наблюдателя
     */
    public function notify() {
        $this->observer->execute($this->nameDocument, "Текст уведомления", "event");
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
     * 
     * @return string
     */
    public function getNameDocument() {
        return $this->nameDocument;
    }
    
    /**
     * 
     * @return string
     */
    public function getName() {
        return $this->nameDocument;
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
    }
    
    /**
     * Добавляет массив ключевых слов
     * @param array $keyWords
     */
    public function addKeyWords($keyWords) {
        foreach ($keyWords as $keyWord) {
            $this->keywords[] = strtolower($keyWord);   
        }        
    }
    
    /**
     * По заданному $this->source парсит страницу 
     */
    public function createResources() {
        $resourceParser = new \parser\ResourceParser();
        $rawResources = $resourceParser->getResource($this->source);
        foreach ($rawResources as $rawResource) {
            $this->resources[] = new \material\Resource($rawResource['name'], $rawResource['tag']);
            $this->addKeyWord($rawResource['tag']);
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
    
    /**
     * Редактированеи документа
     * @param string $content
     */
    public function editDocument($content) {
        
        $this->notify();
    }
}
