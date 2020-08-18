<?php
/**
 * Description Добавляет ключевые слова
 */


use config\Config;
use repository\Repository;
use serialize\Serialize;
use usecase\catalog\GetCatalog;
use usecase\document\DocumentAddTag;

require_once '../config/bootstrap.php';


$repository = new Repository(Config::connect());

$hreq = new HTTP_Request2Xml("schemas/command.xsd", null, "AddTag");
if (!$hreq->isEmpty()) {
    $hreq->validate();

    $res = new DocumentAddTag($_POST['document'], $_POST['keyWord']);
    $res->setRepository($repository);
    if (!$res->execute()) {
    exit("Все плохо");
    }
}

$documentList = new GetCatalog(\config\Config::pathToKnowledgebase);
$documentList->setRepository($repository);
$catalog = $documentList->execute();
$serialize = new Serialize();
$xml = $serialize->objToXMLandXSL($catalog, "stylesheets/AddTag/AddTag.xsl");
XML_Output::tryHTML($xml,TRUE);
