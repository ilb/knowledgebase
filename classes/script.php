<?php

/**
 * Файл чисто для сценария, не использовать вообще нигде!
 */

ini_set("error_reporting", E_ALL);
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);

require_once '__autoload.php';

$controller = new \controller\AdminController();
$controller->createAll("../index.html");

$admin = new \user\Admin("Admin1");
$admin->setController($controller);

$mentor1 = new \user\Mentor("Mentor1");
$mentor1->setController($controller);

$user1 = new \user\User("User1");
$controller->connectionUser($user1);
$user1->setController($controller);

$user2 = new \user\User("User2");
$controller->connectionUser($user2);
$user2->setController($controller);

$user3 = new \user\User("User3");
$controller->connectionUser($user3);
$user3->setController($controller);

$admin->subscribeUser("#process_razrabotki_ICONIX", $user1);
$admin->subscribeUser("knowlegebase.xhtml", $user1);
$admin->subscribeUser("knowlegebase.xhtml", $user2);

$mentor2 = $admin->addMentor($user3);
$mentor2->setController($controller);

/**
 * Поиск по ключевому слову 
 * Пользователь ищет по ключевому слову iconix в ответ получает ссылку 
 * На рессурс и класс документа -- наверное лучше это убрать
 */
echo "Поиск";
var_dump($user1->search("iconix"));

/**
 * Ментор тоже может искать
 */
echo "ПОИСК";
var_dump($mentor2->search("inzener-programmist"));

/**
 * Просмотр всех подписок 
 */
echo "ПОДПИСКИ ПЕРВОГО ПОЛЬЗОВАТЕЛЯ";
var_dump($user1->viewSubscriptions());
echo "ПОДПИСКИ ВТОРОГО ПОЛЬЗОВАТЕЛЯ";
var_dump($user2->viewSubscriptions());

$user1->addOffer("tdd.xhtml#Problems");
// нужно добавить заполнение контентом предложенные правки

$mentor2->subscribeUser("tdd.xhtml", $user2);
echo $mentor2->getReportSubscription();

$admin->acceptOffer($user1->getLogin(), "tdd.xhtml#Problems");
echo "-----------------";
echo "\r\nИЗМЕНЯЕМ РЕСУРС knowlegebase.xhtml#kratkoe_opisanie_proekta\r\n";
$admin->editResource("knowlegebase.xhtml#kratkoe_opisanie_proekta", "");
