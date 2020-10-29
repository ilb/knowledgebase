<?php

use config\Config;
use parser\SVNParser;
use repository\Repository;
use ru\ilb\knowledgebase\VCS;
use usecase\notify\Notificate;
use vcsclient\VCSClientFactory;

require_once '../config/bootstrap.php';

$hreq = new HTTP_Request2Xml("schemas/command.xsd", $_GET, "VCS");
$req = new VCS();
if (!$hreq->isEmpty()) {
    $hreq->validate();
    $req->fromXmlStr($hreq->getAsXML());
}

if ( isset($_POST['diff']) ) {
    $repo = new Repository(Config::getInstance()->connection);
    $pars = new SVNParser($_POST['diff']);
    $result = $pars->getEvent();
    $data = $pars->getData();
    $result = $pars->merge($result, $data);
    unset($data, $pars);
    $notify = new Notificate($result);
    $notify->setRepository($repo);
    $notify->execute();
}

$VCSClientFactory = new VCSClientFactory(Config::getInstance()->filespath);
$VCSClient = $VCSClientFactory->getVCSClient($req->getRepo());
$VCSClient->update();
