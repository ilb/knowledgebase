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
        // Здесь разместить парсера для создания документов
    }
} 
