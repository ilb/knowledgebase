<?php


use config\Config;
use repository\Repository;
use ru\ilb\knowledgebase\DeleteDocument;
use usecase\document\DocumentDelete;

require_once '../config/bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] != "Delete") {
    header("HTTP/1.0: 400 Bad Request");
    echo "Не верный метод запроса";
    exit(1);
}
$repo = new Repository(Config::getInstance()->connection);
$hreq = new HTTP_Request2Xml("schemas/command.xsd", null, "DeleteDocument");
$req = new DeleteDocument();
if (!$hreq->isEmpty()) {
    $hreq->validate();
    $req->fromXmlStr($hreq->getAsXML());
}

$del = new DocumentDelete($req->getName());
$del->setRepository($repo);
$del->execute();
