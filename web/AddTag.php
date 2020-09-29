<?php
/**
 * Description Добавляет ключевые слова
 */


use config\Config;
use repository\Repository;
use ru\ilb\knowledgebase\AddTag;
use serialize\Serialize;
use usecase\catalog\GetCatalog;
use usecase\document\DocumentAddTag;

require_once '../config/bootstrap.php';


$repository = new Repository(Config::getInstance()->connection);

$hreq = new HTTP_Request2Xml("schemas/command.xsd", null, "AddTag");
$req = new AddTag();
if (!$hreq->isEmpty()) {
    $hreq->validate();
    $req->fromXmlStr($hreq->getAsXML());
    $res = new DocumentAddTag($req->getDocument(),$req->getKeyWord());
    $res->setRepository($repository);
    if (!$res->execute()) {
        exit("Все плохо");
    }
}

$documentList = new GetCatalog(Config::getInstance()->filespath);
$documentList->setRepository($repository);
$catalog = $documentList->execute();
$serialize = new Serialize();
$xml = $serialize->objToXMLandXSL($catalog, "stylesheets/AddTag/AddTag.xsl");
XML_Output::tryHTML($xml,TRUE);
