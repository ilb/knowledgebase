<?php

use config\Config;
use parser\DocumentParser;
use ru\ilb\knowledgebase\Dir;
use serialize\Serialize;

require_once '../config/bootstrap.php';

$hreq = new HTTP_Request2Xml("schemas/command.xsd", null, "Dir");
$req = new Dir();
if (!$hreq->isEmpty()) {
    $hreq->validate();
    $req->fromXmlStr($hreq->getAsXML());
}
$dir = $req->getDir();
$path = Config::getInstance()->filespath;
if ($dir) {
    $path .= "/" . $dir;
}
$docs = new DocumentParser();
$docs = $docs->getDirandDocs($path);
if ($dir) {
    for ($i = 0; $i < count($docs); $i++) {
        $docs[$i]['parent'] = $dir;
    }
}
$ser = new Serialize();
$xml = $ser->arrToXMLandXSL($docs, "stylesheets/Table/Table.xsl");
XML_Output::tryHTML($xml,TRUE);