<?php

use config\Config;
use ru\ilb\knowledgebase\Dir;
use serialize\Serialize;
use usecase\catalog\LoadDir;

require_once '../config/bootstrap.php';

$hreq = new HTTP_Request2Xml("schemas/command.xsd", null, "Dir");
$req = new Dir();
if (!$hreq->isEmpty()) {
    $hreq->validate();
    $req->fromXmlStr($hreq->getAsXML());
}
$dir = $req->getDir();
$path = Config::getInstance()->filespath;
$loadDir = new LoadDir($dir, $path);
$docs = $loadDir->execute();
$ser = new Serialize();

$xml = $ser->arrToXMLandXSL($docs, "stylesheets/Table/Table.xsl");
XML_Output::tryHTML($xml,TRUE);
