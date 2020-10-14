<?php

use config\Config;
use repository\Repository;
use ru\ilb\knowledgebase\RemoveSubscription;
use usecase\subscriptions\SubscriptionDelete;

require_once '../config/bootstrap.php';

$repository = new Repository(Config::getInstance()->connection);

$hreq = new HTTP_Request2Xml("schemas/command.xsd", null, "RemoveSubscription");
$req = new RemoveSubscription();

if (!$hreq->isEmpty()) {
    $hreq->validate();
    $req->fromXmlStr($hreq->getAsXML());
    $tag = $req->getTag();
    $doc = $req->getDocument();
    if (strlen($tag) != 0) {
        $doc .= "#" . $tag;
    }
    // если поставленна галочка группы то значение будет равнятся on
    $addSubscription = new SubscriptionDelete($doc, Config::getInstance()->login);
    $addSubscription->setRepository($repository);
    $addSubscription->execute();
    header("Location: SubscriptionsList.php");
}

