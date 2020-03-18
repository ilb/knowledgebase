<?php

namespace contrller;

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
     * Создает документ
     */
    public function createDocument($nameDocument, $sources) {
        $this->catalog->crateDocument($nameDocument, $sources); 
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
     * Добавляет ключевое слово дял документа
     * @param string $nameDocument
     * @param string $keyWord
     */
    public function addKeyWords($nameDocument, $keyWord) {
        $doc = $this->catalog->getDocumentByName($nameDocument);
        $doc->addKeyWord($keyWord);
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
}
