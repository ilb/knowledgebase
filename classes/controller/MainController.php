<?php

namespace contrller;

class MainController {
    /**
     *
     * @var \subscription\Subscriptions
     */
    private $subscriptions;
    
    /**
     *
     * @var \observer\ElementObserver
     */
    private $observer;
    
    /**
     *
     * @var \elements\Catalog
     */
    private $catalog;
    
    /**
     * Создает $this->subscriptions по классу \subscription\Subscriptions
     */
    public function createSubscriptions() {
        $this->subscriptions = new \subscription\Subscriptions();
    }
    
    /**
     * Создает $this->observer по классу \observer\ElementObserver
     */
    public function createObserver() {
        $this->observer = new \observer\ElementObserver();
        if (!empty($this->subscriptions)) {
            $this->observer->setSubscriptions($this->subscriptions);
        }
    }
    
    /**
     * Создает $this->catalog по классу \elements\Catalog
     */
    public function createCatalog() {
        $this->catalog = new \elements\Catalog("../../index.html");
        $this->catalog->createDocuments();
    }
    
    /**
     * Тестовый метод для проверки генерируется ли структура документов и ресурсов
     * Нужно добавить проверку исключения в ресурсы там кидает исключение страница не найдена
     * Warning: file_get_contents(https://ilb.github.io/devmethodology/presentation/): failed to 
     * open stream: HTTP request failed! HTTP/1.1 404 Not Found
     *  in C:\OSPanel\domains\knowledgebase\classes\adapter\Adapter.php on line 7
     */
    public function createStructur() {
        $docs = $this->catalog->getDocuments();
        var_dump($docs);
        echo "-------------------------------------------------------------------------------------------------------------------";
        foreach ($docs as $doc) {
            $doc->createResources();
            var_dump($doc->getResources());
            echo "+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++";
        }
    }
}

