<?php

require_once '../config/bootstrap.php';

$hreq = new HTTP_Request2Xml("schemas/command.xsd", null, "Dir");
$req = new \ru\ilb\knowledgebase\Dir();
if (!$hreq->isEmpty()) {
    $hreq->validate();
    $req->fromXmlStr($hreq->getAsXML());
}
$dir = $req->getDir();
$path = \config\Config::getInstance()->filespath;
if ($dir) {
    $path .= "/" . $dir;
}
$docs = new \parser\DocumentParser();
$docs = $docs->getDirandDocs($path);
if ($dir) {
    for ($i = 0; $i < count($docs); $i++) {
        $docs[$i]['parent'] = $dir;
    }
}
$ser = new \serialize\Serialize();
$xml = $ser->arrToXMLandXSL($docs, "stylesheets/Table/Table.xsl");
XML_Output::tryHTML($xml,TRUE);