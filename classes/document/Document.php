<?php

namespace document;


class Document {
    
    /**
     * источник данных документа
     * @var string
     */
    private $source;
    
    /**
     * Массив ресурсов
     * @var array<\resource\Resource>
     */
    private $resources = [];

    /**
     * @var \observer\ObserverImpl
     */
    private $observer;
   
    /**
     * Ключевые слова для поиска
     * @var array<string>
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
        $this->keywords[] = $nameDocument;
    }
    
    /**
     * 
     * @param \observer\ObserverImpl $observer
     */
    public function setObserver($observer) {
        $this->observer = $observer;
    }
    
    /**
     * Для уведомления наблюдателя
     */
    public function notify() {
        $this->observer->execute($this->nameDocument, "Изменение", "event");
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
     * @return array<string>
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
            $this->resources[] = new \resource\Resource(
                    $rawResource['name'], 
                    $this->nameDocument . "#" . $rawResource['tag']
            );
            $this->addKeyWord($rawResource['tag']);
        }
    }
    
    /**
     * 
     * @return array<\resource\Resource>
     */
    public function getResources() {
        return $this->resources;
    }
    
    /**
     * 
     * @param string $tagResource
     * @return \resource\Resource
     */
    public function getResourceByTag($tagResource) {
        foreach ($this->resources as $resource) {
            if ($resource->getTag() == $tagResource) {
                return $resource;
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
    
    /**
     * 
     * @return string
     */
    public function getSource() {
        return $this->source;
    }
    
    public function setSource($source) {
        $this->source = $source;
        $this->notify();
    }
    
    /**
     * Удаляет ресурс по имени
     * @param string $nameResource
     */
    public function deleteResource($nameResource) {
        foreach ($this->resources as $key => $resource) {
            if ($resource->getTag() == $nameResource) {
                unset($this->resources[$key]);
                return true;
            }
        }
        return false;
    }
    
    /**
     * @param string $nameResource
     * @param string $content
     */
    public function editResource($nameResource, $content) {
        $res = $this->getResourceByTag($nameResource);
        $res->editResource($content);
    }
    
    /**
     * Удаляет ключевое слово
     * @param string $keyWord
     */
    public function deleteKeyWord($keyWord) {
        $index = array_search($keyWord, $this->keywords);
        unset($this->keywords[$index]);
    }
}
