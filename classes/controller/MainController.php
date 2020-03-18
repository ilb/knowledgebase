<?php

/**
 * Файл чисто для сценария, не использовать вообще нигде!
 */

namespace contrller;

ini_set("error_reporting", E_ALL);
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);

require_once '../__autoload.php';

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
     *
     * @var \offers\Offers
     */
    private $offers;

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
    public function createCatalog() {
        $this->catalog = new \catalog\Catalog("../../index.html");
        $this->catalog->createDocuments();
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
     * 
     * @param \user\User $user
     */
    public function viewDontReadSubsc($user) {
        return $this->subscriptions->getSubscriptionByUser($user, 1);
    }

    /**
     * Добавляет подписку
     * @param string $nameElement
     * @param \user\User $user
     */
    public function addSubscribtion($nameElement, $user) {
        $this->subscriptions->subscribe($nameElement, $user);
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
     * Создает \offers\Offers
     */
    public function createOffers() {
        $this->offers = new \offers\Offers();
    }
    
    /**
     * @param \user\User $user
     */
    public function addOffer($user, $link) {
        $offerObserver = new \observer\OfferObserver();
        $this->offers->createOffer($link, $user, $offerObserver);
    }
    
    /**
     * Создает все сразу
     */
    public function createAll() {
        $this->createCatalog();
        $this->createSubscriptions();
        $this->createObserver();
        $this->createOffers();
        $this->createStructur();
    }
    
    public function viewDontPublishedOffer() {
        return $this->offers->getDontPublushedOffer();
    }

    /**
     * @param string $userName
     * @param string $link
     */
    public function acceptOffer($userName, $link) {
        $this->offers->acceptOffer($userName, $link, $this->catalog);
    }
    /**
     * принимает ключевое слово ищет документ и рессурс
     * @param string $tag
     */
    public function checkNotificate($tag) {
        /**
         * Двемерный массив элемент имеет ключ document и link
         * Пример:
         * [
         *  [   
         *    "document" = > class document\Document#17 (5) {}, 
         *    "link" => "https://ilb.github.io/devmethodology/knowlegebase.xhtml#kratkoe_opisanie_proekta"
         *  ],
         *  ...
         * ]
         */
        $findDocument = $this->catalog->searchByKeyword($tag);
        foreach ($findDocument as $document) {
            $res = $document['document']->getResourceByTag($tag);
            $res->editResource("");   
        }        
    }
    
    /**
     * Возвращает массив с ссылками по подпискам
     * @param array(\subscription\Subscription) $subscriptions
     * @return array
     */
    public function getUrlBySubscription($subscriptions) {
        $result = [];
        foreach ($subscriptions as $subscription) {
            $nameElement = $subscription->getElement();
            if (preg_match_all("/[#]/", $nameElement)) {
                $nameElement = explode("#", $nameElement)[1];
            }
            $document = $this->catalog->searchByKeyword($nameElement);
            foreach ($document as $value) {
                $result[$nameElement][] = $value['link'];
            }            
        }
        return $result;
    }

}

$mc = new MainController();

/**
 * Создать по одному или использовать 
 * $mc->createAll();
 * ---
 * Создает каталог и заполняет документами
 */
$mc->createCatalog();

/**
 * Создает экземпляр класса подписок
 */
$mc->createSubscriptions();

/**
 * Создает наблюдателя для прикрепления в документы и ресурсы
 */
$mc->createObserver();

/**
 * Создает список предложенных на корректировку статей
 */
$mc->createOffers();
/**
 * создает всю структуру документов и рессурсов парсит все сайты 
 */
$mc->createStructur();

/**
 * Когда есть структура можно делать все действия
 */
$user = new \user\User("User1");
$user1 = new \user\User("User2");
/**
 * ресурс обязательно с #
 */
echo "\033[32m" . "User1 подписали на ресурс #kratkoe_opisanie_proekta и документ usecases.xhtml\r\n";
echo "User2 подписали на документ knowlegebase.xhtml \r\n";
$mc->addSubscribtion("knowlegebase.xhtml", $user1); 
$mc->addSubscribtion("#kratkoe_opisanie_proekta", $user);
$mc->addSubscribtion("usecases.xhtml", $user);

/**
 * Просматривает все подписки 
 * Одну читает 
 * Смотрит какие еще не прочитаные
 */
echo "Выводит все подписки пользователя User1\r\n";
echo "\033[38m";
var_dump($mc->viewSubscription($user));
$mc->readSubscribe($user, "#kratkoe_opisanie_proekta");
echo "\033[32m" . "Выводит все не прочитаные подписки пользователя User1\r\n";
echo "\033[38m";
var_dump($mc->viewDontReadSubsc($user));

/**
 * Поиск
 */
echo "\033[32m" . "Поиск доккумента и получения ссылки на ресурс по ключевому слову\r\n";
echo "\033[38m";
var_dump($mc->searchDocument("kratkoe_opisanie_proekta"));

/**
 * Предложение статьи на редактирование
 */
$link = "knowlegebase.xhtml#kratkoe_opisanie_proekta";
$mc->addOffer($user, $link);
echo "\033[32m" . "User1 предложил корректировку $link\r\n";
/**
 * Просмотр еще не опубликованных предложений
 */
echo "Просмотр всех предложенных корректировок\r\n";
echo "\033[38m";
var_dump($mc->viewDontPublishedOffer());

/**
 * Одобрение статьи
 * только админом
 */
echo "\033[32m" . "Предложение User1 приняли его оповещают и меняют статью вызывая рассылку\r\n";
echo "\033[38m";
$mc->acceptOffer($user->getLogin(), $link);
echo "\r\n";

/**
 * После изменения статьи подписка становится не прочитанной
 */
echo "\033[32m" . "Просмотр всех не прочитаных подписок User1 \r\n";
echo "\033[38m";
var_dump($mc->viewDontReadSubsc($user));

echo "\033[32m" . " Получение ссылок \r\n";
echo "\033[38m";
$subscriptions = $mc->viewSubscription($user);
var_dump($mc->getUrlBySubscription($subscriptions));
