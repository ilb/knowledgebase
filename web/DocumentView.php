<?php

use ru\ilb\knowledgebase\DocumentView;
use serialize\Serialize;

require_once '../config/bootstrap.php';

$hreq = new HTTP_Request2Xml("schemas/command.xsd", null, "DocumentView");
$req = new DocumentView();
if (!$hreq->isEmpty()) {
    $hreq->validate();
    $req->fromXmlStr($hreq->getAsXML());
}
$ser = new Serialize();
$xml = $ser->objToXMLandXSL($req, "stylesheets/DocumentList/DocumentView.xsl");
XML_Output::tryHTML($xml,TRUE);