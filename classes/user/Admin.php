<?php

namespace user;

class Admin extends Mentor {
    
    /**
     * @var string
     */
    private $login;
    
    /**
     * @param string $login
     */
    public function __construct($login) {
        $this->login = $login;
    }
    
    /**
     * @return string
     */
    public function getLogin() {
        return $this->login;
    }
    
    /**
     * Создание документа
     * @param string $nameDocument
     * @param string $source
     */
    public function createDocument($nameDocument, $source) {
        $this->controller->createDocument($nameDocument, $source);
    }

    /**
     * Редкактированеи документа
     * @param string $nameDocument
     * @param string $content
     */
    public function editDocument($nameDocument, $content) {
        $this->controller->editDocument($nameDocument, $content);
    }
    
    /**
     * Редкактированеи ресурс
     * @param string $nameResource
     * @param string $content
     */
    public function editResource($nameResource, $content) {
        $this->controller->editResource($nameResource, $content);
    }
    
    /**
     * Имя рессурса docName#tag
     */
    public function deleteResource($nameResource) {
        $this->controller->deleteResource($nameResource);
    }
    
    /**
     * 
     * @param string $nameDocument
     */
    public function deleteDocument($nameDocument) {
        $this->controller->deleteDocument($nameDocument);
    }
    
    /**
     * 
     * @param string $nameDocument
     * @param string $keyWord
     */
    public function deleteKeyWord($nameDocument, $keyWord) {
        $this->controller->deleteKeyWord($nameDocument, $keyWord);
    }
    
    /**
     * 
     * @param string $nameDocument
     * @param string $keyWord
     */
    public function addKeyword($nameDocument, $keyWord) {
        $this->controller->addKeyWords($nameDocument, $keyWord);
    }
    
    /**
     * 
     * @param string $nameDocument
     * @param string $newSource
     */
    public function changeSource($nameDocument, $newSource) {
        $this->controller->changeSource($nameDocument, $newSource);
    }
    
    /**
     * 
     * @param \user\User $user
     * @return \user\Mentor
     */
    public function addMentor($user) {
        return $this->controller->addMentor($user);
    }
    
    /**
     * Подписать пользователя
     * @param string $nameElement
     * @param \user\User $user
     */
    public function subscribeUser($nameElement, $user) {
        $this->controller->addSubscribtion($nameElement, $user);
    }
    
    /**
     * Отчет о всех подписках пользователей
     */
    public function getReportSubscription() {
        $this->controller->getReportSubscribtions();
    }
    
    /**
     * Получает все предложения без фильтров
     */
    public function getOffers() {
        $this->controller->getOffers();
    }
    
    /**
     * @param string $nameOffer
     */
    public function acceptOffer($nameUser, $link) {
        $this->controller->acceptOffer($nameUser, $link);
    }
    
    /**
     * отчет о предложенных корректировках
     */
    public function getReportOffers() {
        $this->controller->getReportOffers();
    }
}