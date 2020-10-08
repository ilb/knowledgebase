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
$docContext = str_replace("href=\"/oooxhtml/oooxhtml.xsl\"", "href=\"oooxhtml/oooxhtml.xsl\"", $docContext);
$d = strpos($docContext, "</body>");
$dop = "<file>$allName</file>" .
    "<user>User1</user>";

if ("ldap") {
    $groups = new GetGroups();
    $groups = $groups->execute();
    $dop .= "<groups>";
    foreach ($groups as $group) {
        $dop .= "<group>{$group['name']}</group>";
    }
    $dop .= "</groups>";
}

$docContext = substr($docContext, 0, $d) . $dop . substr($docContext, $d);
header("Content-type: text/xml");
echo $docContext;
//XML_Output::tryHTML($docContext,TRUE);
