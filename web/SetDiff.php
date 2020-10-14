<?php

use config\Config;
use parser\SVNParser;
use repository\Repository;
use ru\ilb\knowledgebase\GetDiff;
use usecase\notify\Notificate;

require_once '../config/bootstrap.php';

if ( $_SERVER['REQUEST_METHOD'] != "POST") {
    header("HTTP/1.0: 400 Bad Request");
    echo "Не верный метод запроса";
    exit(1);
}
$repo = new Repository(Config::getInstance()->connection);
$hreq = new HTTP_Request2Xml("schemas/command.xsd", null, "GetDiff");
$req = new GetDiff();
if (!$hreq->isEmpty()) {
    $hreq->validate();
    $req->fromXmlStr($hreq->getAsXML());
}

$pars = new SVNParser($req->getDiff());
$result = $pars->getEvent();
$data = $pars->getData();
//$result = $pars->getResource($result, $data);
$result = $pars->merge($result, $data);
unset($data, $pars);
$notify = new Notificate($result);
$notify->setRepository($repo);
if ($notify->execute()) {
    header("HTTP/1.0: 200 Ok");
} else {
    header("HTTP/1.0: 404 Not Found");
}
