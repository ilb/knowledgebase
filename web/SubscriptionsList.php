<?php
/*
 * Description показывает все подписки на которые вы подписаны
 */

use config\Config;
use repository\Repository;
use ru\ilb\knowledgebase\SubscriptionViewed;
use serialize\Serialize;
use usecase\subscriptions\SubscriptionView;

require_once '../config/bootstrap.php';

$repository = new Repository(Config::connect());
$hreq = new HTTP_Request2Xml("schemas/command.xsd", null, "SubscriptionViewed");
$req = new SubscriptionViewed();
if (!$hreq->isEmpty()) {
    $hreq->validate();
    $req->fromXmlStr($hreq->getAsXML());
}
// мусор скоро уберу
//if (isset($_GET['link_to'])) {
//
////    $arr = explode("/", $_GET['link_to']);
////    $material_name = $arr[count($arr)-1];
////    $viewed = new usecase\subscriptions\SubscribtionViewed("USer1", $material_name);
////    $viewed->setRepository($repository);
////    if ($viewed->execute()) {
////        header("Location: ". $_GET['link_to']);
////    }
////    exit("<h2>Что то пошло не так</h2>");
//}

// Передавать логин пользователя
$sub = new SubscriptionView("USer1");
$sub->setRepository($repository);
$response = $sub->execute();
$serialize = new Serialize();
$xml = $serialize->objToXMLandXSL($response, "stylesheets/SubscriptionList/SubscriptionList.xsl");
XML_Output::tryHTML($xml,TRUE);
