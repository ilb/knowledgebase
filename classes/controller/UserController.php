<?php

namespace controller;

class UserController {

    /**
     *
     * @var \subscription\Subscriptions
     */
    protected $subscriptions;

    /**
     *
     * @var \observer\ElementObserver
     */
    protected $observer;

    /**
     *
     * @var \catalog\Catalog
     */
    protected $catalog;

    /**
     *
     * @var \offers\Offers
     */
    protected $offers;

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
        $this->observer = new \observer\ObserverImpl();
        if (!empty($this->subscriptions)) {
            $this->observer->setSubscriptions($this->subscriptions);
        }
    }

    /**
     * Создает $this->catalog по классу \elements\Catalog
     */
    public function createCatalog($source) {
        $this->catalog = new \catalog\Catalog($source);
        $this->catalog->createDocuments();
    }

    /**
     * Создает \offers\Offers
     */
    public function createOffers() {
        $this->offers = new \offers\Offers();
    }

    /**
     * Тестовый метод для проверки генерируется ли структура документов и ресурсов
     * 
     */
    public function createStructur() {
        $docs = $this->catalog->getDocuments();
        foreach ($docs as $doc) {
            $doc->createResources();
            //Добавляет наблюдателя всем
            $doc->setObserver($this->observer);
            foreach ($doc->getResources() as $resource) {
                $resource->setObserver($this->observer);
            }
        }
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
    }
    
    /**
     * Поиск документа по ключевому слову
     */
    public function searchDocument($word) {
        return $this->catalog->searchByKeyword($word);
    }
    
    /**
     * Показывает все подписки пользователя
     * @param \user\User $user
     * @return \subscription\Subscriptions
     */
    public function viewSubscription($user) {
        return $this->subscriptions->getSubscriptionByUser($user);
    }
    
    /**
     * @param \user\User $user
     */
    public function viewDontReadSubsc($user) {
        return $this->subscriptions->getSubscriptionByUser($user, 1);
    }
    
    /**
     * Можно наверное чисто логин передавать
     * Пользователь прочитал
     * @param \user\User $user
     * @param string $nameElement
     */
    public function readSubscribe($user, $nameElement) {
        $s = $this->subscriptions->getSubscriptionsByUserElement($user, $nameElement);
        $s->setIsRead(true);
    }
    
    /**
     * @param \user\User $user
     */
    public function addOffer($user, $link) {
        $offerObserver = new \observer\OfferObserver();
        $this->offers->createOffer($link, $user, $offerObserver);
    }

}
