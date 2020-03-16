<?php
/**
 * Файл чисто для тестов не использовать как реальный
 */

namespace contrller;

$start = microtime(true);
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
        $this->createSubscriptions();
        $this->createObserver();
        $docs = $this->catalog->getDocuments();
        foreach ($docs as $doc) {
            //var_dump($doc);
            //echo "-------------------------------------------------------------------------------------------------------------------\r\n";
            $doc->createResources();
            //var_dump($doc->getResources());
            //echo "+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++\r\n";
            
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
        echo "++++++++++++++SEARCH------------------------\r\n";
        $word = "precedent";
        var_dump($this->catalog->searchByKeyword($word));
        echo "+++++++++++++SEARCH------------------------ \r\n";
        $docs = $this->catalog->getDocuments();
        $word = "kratkoe_opisanie_proekta";
        var_dump($this->catalog->searchByKeyword($word));
    }
    
    
    public function viewSubscription($user) {
        /**
         * массив не прочитанных подписок 
         * Обработать для предоставления пользователю чтобы смог читать
         * 
         * Добавить еще один метод которы даже прочитанные тоже будет выдавать
         * а тут только для обязательного ознакомления 
         */
        $material = $this->subscriptions->getSubscriptionByUser($user);
        var_dump($material);
        
    }

    public function viewDontReadSubsc($user) {
        $material = $this->subscriptions->getSubscriptionByUser($user, 1);
        var_dump($material);
    }

    public function addSubscribtion() {
        $arr = ['knowlegebase.xhtml', '#kratkoe_opisanie_proekta', '#sloj_slabosvjzann_h_servisov', '#inzener-programmist'];
        for ($i = 0; $i < 4; $i++) {
            $user = new \user\User("User_" . $i);
            $this->subscriptions->subscribe($arr[$i], $user);
        }
        $user = new \user\User("User_1");
        $this->subscriptions->subscribe($arr[3], $user);
        $this->subscriptions->subscribe($arr[2], $user);
        $s = $this->subscriptions->getSubscriptionByElementName("#kratkoe_opisanie_proekta");
        foreach ($s as $val) {
            $val->setIsRead(true);
        }
    }
    
    public function addOffer($user) {
        $offers = new \offers\Offers();
        $offerObserver = new \observer\OfferObserver();
        // вместо пустой строки должны быть ссылка docName#tagName
        $offers->createOffer("", $user, $offerObserver);       
        $offers->acceptOffer($user->getLogin(), "");
    }
    
    public function checkNotificate() {
        $d = $this->catalog->searchByKeyword("inzener-programmist");
        $res = $d[0]['document']->getResourceByTag("#inzener-programmist");
        $res->editResource("");
    }
}

$mc = new MainController();

$mc->createCatalog();
$mc->createStructur();
echo "\r\n\r\n";
$mc->searchDocument("");
echo "\r\n\r\n";
$mc->addSubscribtion();
$user = new \user\User("User_1");
echo "View all subscription \r\n";
$mc->viewSubscription($user);
echo "\r\n\r\n";
echo "View dont read subscription \r\n";
$mc->viewDontReadSubsc($user);
echo "\r\n\r\n";
echo "Change resource";
$mc->checkNotificate();
echo "\r\n\r\n";
echo "Одобрение документа";
$mc->addOffer($user);
echo "\r\n\r\n";
echo microtime(true) - $start . " sec. \r\n\r\n"; 
