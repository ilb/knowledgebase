<?php

/**
 * Файл чисто для сценария, не использовать вообще нигде!
 */

ini_set("error_reporting", E_ALL);
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);

require_once '__autoload.php';

$adminControll = new \controller\AdminController();
$adminControll->createAll("../index.html");

$admin = new \user\Admin("Admin1");
$admin->setAdminController($adminControll);

$mentor = new \user\Mentor("Mentor1");
$mentor->setController($adminControll);

$user1 = new \user\User("User1");
$adminControll->connctionUser($user1);
$user1->setController($adminControll);

$user2 = new \user\User("User2");
$adminControll->connctionUser($user2);
$user2->setController($adminControll);

$user3 = new \user\User("User3");
$adminControll->connctionUser($user3);
$user3->setController($adminControll);

$admin->subscribeUser("#", $user1);


