<?php
require('DocumentList.php');
/*
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
        if (!$docs[$i]["dir"]) {
            $docCOntext = file_get_contents($path . "/" . $docs[$i]["name"]);
            $out = [];
            preg_match_all("/<title>(.*)<\/title>/", $docCOntext, $out);
            $docs[$i]["title"] = isset($out[1][0]) ? $out[1][0] : "";
        }
        $docs[$i]['parent'] = $dir;
    }
}

$prev = explode("/", $dir);
if (count($prev) == 1) {
    $prev = "";
} else {
    $prev = implode("/", array_slice($prev, 0, count($prev)-1));
}
$docs["parentDir"] = $prev;

$ser = new Serialize();
$xml = $ser->arrToXMLandXSL($docs, "stylesheets/Table/Table.xsl");
XML_Output::tryHTML($xml,TRUE);
*/