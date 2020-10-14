<?php

use config\Config;
use repository\Repository;
use ru\ilb\knowledgebase\DocumentView;
use serialize\Serialize;
use usecase\subscriptions\GetSubscriptionDocUser;

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
$login = Config::getInstance()->login;

preg_match_all("/[a-z]+.*[a-z]+/", $doc, $mathes);
$path = Config::getInstance()->filespath . "/" . $mathes[0][0];

$docContext = file_get_contents($path);

$repo = new Repository(Config::getInstance()->connection);
$subs = new GetSubscriptionDocUser(Config::getInstance()->login, $doc);
$subs->setRepository($repo);
$subs = $subs->execute();
$ser = new Serialize();
$subs = explode("<?xml version=\"1.0\"?>" , $ser->arrToXML($subs))[1];
$docContext = str_replace("href=\"/oooxhtml/oooxhtml.xsl\"", "href=\"oooxhtml/oooxhtml.xsl\"", $docContext);
$d = strpos($docContext, "</body>");
$dop = "<file style='display: none'>$allName</file>" .
    "<document style='display: none'>$doc</document>" .
    "<user style='display: none'>$login</user>" . $subs;
$docContext = substr($docContext, 0, $d) . $dop . substr($docContext, $d);
header("Content-type: text/xml");
echo $docContext;
// если использовать это ломаются скрипты oooxhtml
//XML_Output::tryHTML($docContext,TRUE);
