<?php
/*
 * Description показывает все подписки на которые вы подписаны
 */

use config\Config;
use repository\Repository;
use serialize\Serialize;
use usecase\subscriptions\SubscriptionView;

require_once '../config/bootstrap.php';

$repository = new Repository(Config::connect());
if (isset($_GET['link_to'])) {
    //Прочтена
    $arr = explode("/", $_GET['link_to']);
    $material_name = $arr[count($arr)-1];
    $viewed = new usecase\subscriptions\SubscribtionViewed("USer1", $material_name);
    $viewed->setRepository($repository);
    if ($viewed->execute()) {
        header("Location: ". $_GET['link_to']);
    }
    exit("<h2>Что то пошло не так</h2>");
}

// Передавать логин пользователя
$sub = new SubscriptionView("USer1");
$sub->setRepository($repository);
$response = $sub->execute();
header("Content-type: text/xml");
$serialize = new Serialize();
//var_dump($response);
$xml = $serialize->objToXMLandXSL($response, "stylesheets/SubscriptionList/SubscriptionList.xsl");
echo $xml;
//?>
