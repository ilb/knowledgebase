<?php

use config\Config;
use ru\ilb\knowledgebase\DocumentView;
use serialize\Serialize;

require_once '../config/bootstrap.php';

$hreq = new HTTP_Request2Xml("schemas/command.xsd", null, "DocumentView");
$req = new DocumentView();
if (!$hreq->isEmpty()) {
    $hreq->validate();
    $req->fromXmlStr($hreq->getAsXML());
}
// Наворатил что то вообще ...
$doc = explode("#", $req->getUrl())[0];
$docContext = file_get_contents(Config::getInstance()->filespath . "/" . $doc);
header("Content-type: text/xml");
$docContext = str_replace("href=\"/oooxhtml/oooxhtml.xsl\"", "href=\"oooxhtml/oooxhtml.xsl\"", $docContext);
echo $docContext;
//XML_Output::tryHTML($docContext,TRUE);
