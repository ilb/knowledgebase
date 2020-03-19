<?php

namespace user;

class Admin {
    
    /**
     * @var \controller\AdminController 
     */
    private $adminController;
    
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
     * @param \controller\AdminController $adminController
     */
    public function setAdminController($adminController) {
        $this->adminController = $adminController;
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
        $this->adminController->createDocument($nameDocument, $source);
    }

    /**
     * Редкактированеи документа
     * @param string $nameDocument
     * @param string $content
     */
    public function editDocument($nameDocument, $content) {
        $this->adminController->editDocument($nameDocument, $content);
    }
    
    /**
     * Имя рессурса docName#tag
     */
    public function deleteResource($nameResource) {
        $this->adminController->deleteResource($nameResource);
    }
    
    /**
     * 
     * @param string $nameDocument
     */
    public function deleteDocument($nameDocument) {
        $this->adminController->deleteDocument($nameDocument);
    }
    
    /**
     * 
     * @param string $nameDocument
     * @param string $keyWord
     */
    public function deleteKeyWord($nameDocument, $keyWord) {
        $this->adminController->deleteKeyWord($nameDocument, $keyWord);
    }
    
    /**
     * 
     * @param string $nameDocument
     * @param string $keyWord
     */
    public function addKeyword($nameDocument, $keyWord) {
        $this->adminController->addKeyWords($nameDocument, $keyWord);
    }
    
    /**
     * 
     * @param string $nameDocument
     * @param string $newSource
     */
    public function changeSource($nameDocument, $newSource) {
        $this->adminController->changeSource($nameDocument, $newSource);
    }
    
    /**
     * 
     * @param \user\User $user
     */
    public function addMentor($user) {
        $this->adminController->addMentor($user);
    }
    
    /**
     * Подписать пользователя
     * @param string $nameElement
     * @param \user\User $user
     */
    public function subscribeUser($nameElement, $user) {
        $this->adminController->addSubscribtion($nameElement, $user);
    }
    
    /**
     * Отчет о всех подписках пользователей
     */
    public function getReportSubscription() {
        $this->adminController->getReportSubscribtions();
    }
    
    /**
     * Получает все предложения без фильтров
     */
    public function getOffers() {
        $this->adminController->getOffers();
    }
    
    /**
     * @param string $nameOffer
     */
    public function acceptOffer($nameOffer, $link) {
        $this->adminController->acceptOffer($nameOffer, $link);
    }
    
    /**
     * отчет о предложенных корректировках
     */
    public function getReportOffers() {
        $this->adminController->getReportOffers();
    }
}