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

//Получить список всех пользователей и документов и выбирать кого на что подписать
//$repository = new UserRepository(Config::connect());
//$userList = new GetUsersList();
//$userList->setRepository($repository);
//$userList->execute();
//$documentList = new GetCatalog("../web/index.html");
//$documentList->setRepository($repository);
//$catalog = $documentList->execute(); var_dump(posix_getgrnam("docker"));
$repository = new Repository(Config::connect());

$hreq = new HTTP_Request2Xml("schemas/command.xsd", null, "AddSubscription");
$req = new AddSubscription();

if (!$hreq->isEmpty()) {
    $hreq->validate();
    $req->fromXmlStr($hreq->getAsXML());

    // если поставленна галочка группы то значение будет равнятся on
    $addSubscription = new SubscriptionCreate($req->getName(), $req->getDocument(), $req->getGroup() == "on");
    $addSubscription->setRepository($repository);
    $addSubscription->execute();
}

$documentList = new GetCatalog(\config\Config::pathToKnowledgebase);
$documentList->setRepository($repository);
$catalog = $documentList->execute();
$serialize = new Serialize();
$xml = $serialize->objToXMLandXSL($catalog, "stylesheets/AddSubscription/AddSubscription.xsl");
XML_Output::tryHTML($xml,TRUE);

