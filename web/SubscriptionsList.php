<?php
/*
 * Description показывает все подписки на которые вы подписаны
 */

use config\Config;
use repository\Repository;
use ru\ilb\knowledgebase\SubscriptionViewed;
use serialize\Serialize;
use usecase\subscriptions\SubscribtionViewed;
use usecase\subscriptions\SubscriptionView;

require_once '../config/bootstrap.php';

$repository = new Repository(Config::getInstance()->connection);
$hreq = new HTTP_Request2Xml("schemas/command.xsd", null, "SubscriptionViewed");
$req = new SubscriptionViewed();
$login = Config::getInstance()->login;
if (!$hreq->isEmpty()) {
    $hreq->validate();
    $req->fromXmlStr($hreq->getAsXML());
    $material = $req->getLink_to();
    $material .= empty($req->getLink_tag()) ? "" : "#" . $req->getLink_tag();
    $viewed = new SubscribtionViewed($login, $material);
    $viewed->setRepository($repository);
    if ($viewed->execute()) {
        header("Location: DocumentView.php?url-0=" . $req->getLink_to() . "#" .$req->getLink_tag());
    }
}

// Передавать логин пользователя
$sub = new SubscriptionView($login);
$sub->setRepository($repository);
$response = $sub->execute();
$serialize = new Serialize();
$xml = $serialize->objToXMLandXSL($response, "stylesheets/SubscriptionList/SubscriptionList.xsl");
XML_Output::tryHTML($xml,TRUE);
