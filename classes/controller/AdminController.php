<?php

namespace controller;

class AdminController extends MentorController {
    
    /**
     * @var \report\ReportOffers
     */
    private $reportOffer;
    
    /**
     * Создает класс ReportOffers
     */
    public function createReportOffers() {
        $this->reportSubscription = new \report\ReportOffers();
        $this->reportSubscription->setSubscriptions($this->subscriptions);
        $this->reportSubscription->setUsers($this->users);
        $this->reportSubscription->createSerializer();
    }

    /**
     * Создает все сразу
     */
    public function createAll($sourceCatalog) {
        $this->createCatalog($sourceCatalog);
        $this->createSubscriptions();
        $this->createObserver();
        $this->createOffers();
        $this->createStructur();
        $this->createReportSubscriptions();
    }
    
    /**
     * Формирует отчет по предложенным корректировкам
     */
    public function getReportOffers() {
        $this->reportOffer->generateReportAllOffers();
    }
    
    /**
     * @param string $userName
     * @param string $link
     */
    public function acceptOffer($userName, $link) {
        $this->offers->acceptOffer($userName, $link, $this->catalog);
    }
    
    /**
     * Редкатирование документа
     * @param string $nameDocument
     * @param string $content
     */
    public function editDocument($nameDocument, $content) {
        $doc = $this->catalog->getDocumentByName($nameDocument);
        $doc->editDocument($content);
    }
    
    /**
     * Изменения ссылки документа
     * @param string $nameDocument
     * @param string $newSource
     */
    public function changeSource($nameDocument, $newSource) {
        $doc = $this->catalog->getDocumentByName($nameDocument);
        $doc->setSource($newSource);
    }
    
    /**
     * Дает право наставника пользователю
     * @param \user\User $user
     * @return \user\Mentor
     */
    public function addMentor($user) {
        $login = $user->getLogin();
        unset($user);
        return new \user\Mentor($login);
    }
   
    /**
     * Удаляет ресурс по его имени
     * @param string $nameResource
     */
    public function deleteResource($nameResource) {
        $documentName = explode("#", $nameResource)[0];
        $doc = $this->catalog->getDocumentByName($documentName);
        $doc->deleteResource($nameResource);
    }
    
    /**
     * 
     * @param string $nameResource
     * @param string $content
     */
    public function editResource($nameResource, $content) {
        $documentName = explode("#", $nameResource)[0];
        $nameResource = explode("#", $nameResource)[1];
        $doc = $this->catalog->getDocumentByName($documentName);
        $doc->editResource($nameResource, $content);
    }
    
    /**
     * 
     * @param string $nameDocument
     */
    public function deleteDocument($nameDocument) {
        $this->catalog->deleteDocument($nameDocument);
    }
    
    /**
     * 
     * @param string $nameDocument
     * @param string $keyWord
     */
    public function deleteKeyWord($nameDocument, $keyWord) {
        $doc = $this->catalog->getDocumentByName($nameDocument);
        $doc->deleteKeyWord($keyWord);
    }
    
    /**
     * @return \offers\Offers
     */
    public function getOffers() {
        return $this->offers;
    }
}
