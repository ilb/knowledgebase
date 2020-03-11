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
     * @param string $idDoc
     */
    public function __construct($idDoc) {
        $this->idDoc = $idDoc;
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
     *  Добавляет ключевое слово и уведомляет пользователя
     * @param string $keyWord
     */
    private function addKeyWord($keyWord) {
        $this->keywords[] = $keyWord;
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
    public function createResource() {
        // Тут должен быть парсер для ресурсов
    }
}
