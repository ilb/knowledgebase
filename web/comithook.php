<?php

use config\Config;
use ru\ilb\knowledgebase\VCS;
use vcsclient\VCSClientFactory;

require_once '../config/bootstrap.php';

$hreq = new HTTP_Request2Xml("schemas/command.xsd", null, "VCS");
$req = new VCS();
if (!$hreq->isEmpty()) {
    $hreq->validate();
    $req->fromXmlStr($hreq->getAsXML());
}

$VCSClientFactory = new VCSClientFactory(Config::getInstance()->filespath);
$VCSClient = $VCSClientFactory->getVCSClient($req->getRepo());
$VCSClient->update();
$VCSClient->add();
$VCSClient->commit("Update repo " . $req->getRepo());
