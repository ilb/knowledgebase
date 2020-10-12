<?php

namespace document;


use config\Config;
use repository\Repository;
use resource\Resources;

class Document {
    
    /**
     * источник данных документа
     * @var string
     */
    private $source;
    
    /**
     * Массив ресурсов
     * @var \resource\Resources
     */
    private $resources;

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
        $this->resources = new Resources();
        $keyword = $this->resources->createResource($this->source, $this->nameDocument);
        $repo = new Repository(Config::getInstance()->connection);
        $this->IssetKeywords($keyword, $repo);
    }

    /**
     * @param $keywords array
     * @param $repo \repository\Repository
     */
    public function IssetKeywords($keywords, $repo) {
        foreach ($keywords as $keyword) {
            if (!$repo->IssetKeyword($keyword, $this->nameDocument)) {
                $repo->addkeyword($this->nameDocument, $keyword);
            }
        }
    }

    /**
     * @param $resources \resource\Resources
     */
    public function setResources($resources) {
        $this->resources = $resources;
    }
    
    /**
     * 
     * @return \resource\Resources
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
        $this->resources->searchByTag($tagResource);
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
