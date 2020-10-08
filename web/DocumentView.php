<?php

use config\Config;
use ru\ilb\knowledgebase\DocumentView;
use usecase\groups\GetGroups;

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

//$xslt = new XSLTProcessor();
//$xhtml = new DOMDocument();
//$xhtml->loadXML($docContext);
//$xsl = new DOMDocument();
//$xsl->load('oooxhtml/oooxhtml.xsl');
//$xslt->importStylesheet($xsl);
//echo $xslt->transformToXml($xhtml);
//exit(1);

$docContext = str_replace("href=\"/oooxhtml/oooxhtml.xsl\"", "href=\"oooxhtml/oooxhtml.xsl\"", $docContext);
$d = strpos($docContext, "</body>");
$dop = "<file>$allName</file>" .
    "<user>User1</user>";

$docContext = substr($docContext, 0, $d) . $dop . substr($docContext, $d);
header("Content-type: text/xml");
echo $docContext;
//XML_Output::tryHTML($docContext,TRUE);
