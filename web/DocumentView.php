<?php

use config\Config;
use ru\ilb\knowledgebase\DocumentView;
use usecase\document\ViewDocument;

require_once '../config/bootstrap.php';

$hreq = new HTTP_Request2Xml("schemas/command.xsd", null, "DocumentView");
$req = new DocumentView();
if (!$hreq->isEmpty()) {
    $hreq->validate();
    $req->fromXmlStr($hreq->getAsXML());
}
// Наворатил что то вообще ...
$allName = $req->getUrl();
$doc = explode("#", $allName)[0];
$docContext = file_get_contents(Config::getInstance()->filespath . "/" . $doc);

$docContext = str_replace("href=\"/oooxhtml/oooxhtml.xsl\"", "href=\"oooxhtml/oooxhtml.xsl\"", $docContext);
$d = strpos($docContext, "</body>");
$dop = "<file style='display: none'>$allName</file>" .
    "<user style='display: none'>User1</user>";

$docContext = substr($docContext, 0, $d) . $dop . substr($docContext, $d);
header("Content-type: text/xml");
echo $docContext;
// если использовать это ломаются скрипты oooxhtml
//XML_Output::tryHTML($docContext,TRUE);
