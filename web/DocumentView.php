<?php

use config\Config;
use repository\Repository;
use ru\ilb\knowledgebase\DocumentView;
use serialize\Serialize;
use usecase\catalog\GetOnlyDir;
use usecase\subscriptions\GetSubscriptionDocUser;
use vcsclient\VCSClientFactory;

require_once '../config/bootstrap.php';

if (!isset($_SERVER["PATH_INFO"])) {
    header("Location: DocumentList.php");
}
//$hreq = new HTTP_Request2Xml("schemas/command.xsd", null, "DocumentView");
//$req = new DocumentView();
//if (!$hreq->isEmpty()) {
//    $hreq->validate();
//    $req->fromXmlStr($hreq->getAsXML());
//}
//// Наворатил что то вообще ...
//$allName = $req->getUrl();
//if (trim($allName) == "") {
//    header("Location: DocumentList.php");
//}

$allName = trim($_SERVER["PATH_INFO"], "/");

$doc = explode("#", $allName)[0];
$login = Config::getInstance()->login;

preg_match_all("/[a-z]+.*[a-z]+/", $doc, $mathes);
$path = Config::getInstance()->filespath . "/" . $mathes[0][0];

$docContext = file_get_contents($path);
header("Content-type: text/xml");
// TODO:для отображения картинок
$typesImage = ["png", "jpg", "jpeg", "gif"];
$type = explode(".", $path);
foreach ($typesImage as $value) {
    if ($type[count($type)-1] == $value) {
        header("Content-type: image/*");
        echo $docContext;
        exit(0);
    }
}

$repo = new Repository(Config::getInstance()->connection);
$subs = new GetSubscriptionDocUser(Config::getInstance()->login, $doc);
$subs->setRepository($repo);
$subs = $subs->execute();
$ser = new Serialize();

$subs = explode("<?xml version=\"1.0\"?>" , $ser->arrToXML([]))[1];

if (!strpos($docContext, "oooxhtml.xsl")) {
    $head = "<?xml-stylesheet type=\"text/xsl\" href=\"/oooxhtml/oooxhtml.xsl\"?>";
    // убрать стили
    $docContext = str_replace("<link rel=\"stylesheet\" type=\"text/css\" href=\"/oooxhtml/oooxhtml.css\"/>", "", $docContext);
    // убрать скрипты
    $docContext = str_replace("<script type=\"text/javascript\" src=\"/privilegedAPI/web/scripts/privilegedAPI.js\"></script>
        <script type=\"text/javascript\" src=\"/oooxhtml/oooxhtml.js\"></script>", "", $docContext);
    // подключить свои стили
    $d = strpos($docContext, "<html");
    $docContext = substr($docContext, 0, $d) . $head . substr($docContext, $d);
}

$repoDocs = explode("/", $doc);
$vcsFactory = new VCSClientFactory(Config::getInstance()->filespath);
$vcsClient = $vcsFactory->getVCSClient($repoDocs[0]);
$editURL = $vcsClient->info(implode("/", array_slice($repoDocs, 1)));
$editURL = str_replace($_SERVER['ru.bystrobank.apps.svn.ws'], $_SERVER['ru.bystrobank.apps.svn.ws2'], $editURL);

//$docContext = str_replace("href=\"/oooxhtml/", "href=\"oooxhtml/", $docContext);
$d = strpos($docContext, "</body>");
$dir = explode("/", $allName);
$dir = array_slice($dir, 0, count($dir)-1);
$dir = implode("/", $dir);
$dop = "<file style='display: none'>$allName</file>" .
    "<mainDir style='display: none'>$dir</mainDir>" .
    "<document style='display: none'>$doc</document>" .
    "<user style='display: none'>$login</user>" .
    "<editURL style='display:none'>". $editURL[0] . "</editURL>" 
    . $subs;

$docContext = substr($docContext, 0, $d) . $dop . substr($docContext, $d);
header("Content-type: text/xml");
echo $docContext;
// если использовать это ломаются скрипты oooxhtml
//XML_Output::tryHTML($docContext,TRUE);
