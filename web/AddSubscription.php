<?php
/**
 * Description Добавляет пользователю подписки
 */

use config\Config;
use repository\Repository;
use repository\UserRepository;
use ru\ilb\knowledgebase\AddSubscription;
use serialize\Serialize;
use usecase\catalog\GetCatalog;
use usecase\subscriptions\SubscriptionCreate;
use usecase\user\GetUsersList;

require_once '../config/bootstrap.php';

$repository = new Repository(Config::getInstance()->connection);

$hreq = new HTTP_Request2Xml("schemas/command.xsd", null, "AddSubscription");
$req = new AddSubscription();

if (!$hreq->isEmpty()) {
    $hreq->validate();
    $req->fromXmlStr($hreq->getAsXML());
    $tag = $req->getTag();
    $doc = $req->getDocument();
    if ($tag != "---") {
        $doc .= "#" . $tag;
    }
    // если поставленна галочка группы то значение будет равнятся on
    $addSubscription = new SubscriptionCreate($req->getName(), $doc, $req->getGroup() == "on");
    $addSubscription->setRepository($repository);
    $addSubscription->execute();
    header("Location: SubscriptionsList.php");
}

$documentList = new GetCatalog(Config::getInstance()->filespath);
$documentList->setRepository($repository);
$catalog = $documentList->execute();
$serialize = new Serialize();
$xml = $serialize->objToXMLandXSL($catalog, "stylesheets/AddSubscription/AddSubscription.xsl");
XML_Output::tryHTML($xml,TRUE);

