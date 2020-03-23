<?php

/**
 * Файл чисто для сценария, не использовать вообще нигде!
 */

ini_set("error_reporting", E_ALL);
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);

require_once '__autoload.php';

/**
 *  !!
 * Вместо контроллера надо придумать класс который будет отвечать 
 * за все действия ????
 * в котором все будет собираться как сборник
 */
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
echo "\033[32m";
echo "ПОИСК";
echo "\033[38m";
var_dump($mentor2->search("inzener-programmist"));

/**
 * Просмотр всех подписок 
 */
echo "\033[32m";
echo "ПОДПИСКИ ПЕРВОГО ПОЛЬЗОВАТЕЛЯ";
echo "\033[38m";
var_dump($user1->viewSubscriptions());

echo "\033[32m";
echo "ПОДПИСКИ ВТОРОГО ПОЛЬЗОВАТЕЛЯ";
echo "\033[38m";
var_dump($user2->viewSubscriptions());

$user1->addOffer("tdd.xhtml#Problems");
// нужно добавить заполнение контентом предложенные правки

echo "\033[32m";
echo "Получаем отчет о подписках всех пользователей\r\n";
$mentor2->subscribeUser("tdd.xhtml", $user2);
echo "\033[38m";
echo $mentor2->getReportSubscription();

echo "\033[32m";
echo "Администратор принял поправки на изменение\r\n";
echo "\033[38m";
$admin->acceptOffer($user1->getLogin(), "tdd.xhtml#Problems");

echo "\033[32m";
echo "-----------------";
echo "\r\nИЗМЕНЯЕМ РЕСУРС knowlegebase.xhtml#kratkoe_opisanie_proekta\r\n";
echo "\033[38m";
$admin->editResource("knowlegebase.xhtml#kratkoe_opisanie_proekta", "");
