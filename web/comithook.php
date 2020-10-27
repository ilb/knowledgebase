<?php

use ru\ilb\knowledgebase\VCS;

require_once '../config/bootstrap.php';

$hreq = new HTTP_Request2Xml("schemas/command.xsd", null, "VCS");
$req = new VCS();
if (!$hreq->isEmpty()) {
    $hreq->validate();
    $req->fromXmlStr($hreq->getAsXML());
}

$VCSClientFactory = new \vcsclient\VCSClientFactory($req->getRepo());
$VCSClient = $VCSClientFactory->getVCSClient();
$VCSClient->update();
$VCSClient->add();
$VCSClient->commit("Update repo " . $req->getRepo());
