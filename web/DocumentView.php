<?php

use config\Config;
use repository\Repository;
use ru\ilb\knowledgebase\DocumentView;
use serialize\Serialize;
use usecase\catalog\GetOnlyDir;
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

$dirs = new GetOnlyDir();
$dirs = $dirs->execute();
$repo = new Repository(Config::getInstance()->connection);
$subs = new GetSubscriptionDocUser(Config::getInstance()->login, $doc);
$subs->setRepository($repo);
$subs = $subs->execute();
$ser = new Serialize();
$xmlDirs = explode("<?xml version=\"1.0\"?>" , $ser->arrToXML($dirs))[1];
$xmlDirs = str_replace("response>", "dirs>", $xmlDirs);
$subs = explode("<?xml version=\"1.0\"?>" , $ser->arrToXML($subs))[1];

if (!strpos($docContext, "oooxhtml.xsl")) {
    $head = "<?xml-stylesheet type=\"text/xsl\" href=\"oooxhtml/oooxhtml.xsl\"?>";
    // убрать стили
    $docContext = str_replace("<link rel=\"stylesheet\" type=\"text/css\" href=\"/oooxhtml/oooxhtml.css\"/>", "", $docContext);
    // убрать скрипты
    $docContext = str_replace("<script type=\"text/javascript\" src=\"/privilegedAPI/web/scripts/privilegedAPI.js\"></script>
        <script type=\"text/javascript\" src=\"/oooxhtml/oooxhtml.js\"></script>", "", $docContext);
    // подключить свои стили
    $d = strpos($docContext, "<html");
    $docContext = substr($docContext, 0, $d) . $head . substr($docContext, $d);
}
$docContext = str_replace("href=\"/oooxhtml/", "href=\"oooxhtml/", $docContext);
$d = strpos($docContext, "</body>");
$dop = "<file style='display: none'>$allName</file>" .
    "<document style='display: none'>$doc</document>" .
    "<user style='display: none'>$login</user>" . $subs . $xmlDirs;
$docContext = substr($docContext, 0, $d) . $dop . substr($docContext, $d);
header("Content-type: text/xml");
echo $docContext;
// если использовать это ломаются скрипты oooxhtml
//XML_Output::tryHTML($docContext,TRUE);
