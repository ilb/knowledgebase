<?php

use config\Config;
use parser\SVNParser;
use repository\Repository;
use ru\ilb\knowledgebase\VCS;
use usecase\notify\Notificate;
use vcsclient\VCSClientFactory;

require_once '../config/bootstrap.php';

$hreq = new HTTP_Request2Xml("schemas/command.xsd", $_GET, "VCS");
$req = new VCS();
if (!$hreq->isEmpty()) {
    $hreq->validate();
    $req->fromXmlStr($hreq->getAsXML());
}

//if ( $_SERVER["REQUEST_METHOD"] == "POST" ) {
    $diff = 'Added: trunk/docs/test213.xhtml
===================================================================
--- trunk/docs/test213.xhtml                            (rev 0)
+++ trunk/docs/test213.xhtml    2020-11-03 08:41:01 UTC (rev 45)
@@ -0,0 +1,14 @@
+<?xml version="1.0" encoding="UTF-8"?>
+<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1 plus MathML 2.0 plus SVG 1.1//EN" "http://www.w3.org/2002/04/xhtml-math-svg/xhtml-math-svg-flat.dtd">
+<?xml-stylesheet type="text/xsl" href="/oooxhtml/oooxhtml.xsl"?><html xmlns="http://www.w3.org/1999/xhtml">
+  <head>
+    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
+    <style type="text/css">@page {margin-top:2cm;margin-bottom:2cm;margin-left:2cm;margin-right:2cm;}</style>
+    <title></title>
+    <meta name="generator" content="oooxhtml/1.4"/>
+    <meta name="HeadURL" content="$HeadURL$"/>
+  </head>
+  <body>
+    <div class="container text"/>
+  </body>
+</html>
';
    $repo = new Repository(Config::getInstance()->connection);
    $pars = new SVNParser($diff);
    $result = $pars->getEvent();
    $data = $pars->getData();
    mail("gudov@bystrobank.ru", "База знаний", print_r($data, true), "Content-type: text/plain; charset=utf-8");
    mail("gudov@bystrobank.ru", "База знаний", print_r($data, true), "Content-type: text/plain; charset=utf-8");
    exit(1);
//    $result = $pars->merge($result, $data);
//    unset($data, $pars);
//    $notify = new Notificate($result);
//    $notify->setRepository($repo);
//    $notify->execute();
//}

$VCSClientFactory = new VCSClientFactory(Config::getInstance()->filespath);
$VCSClient = $VCSClientFactory->getVCSClient($req->getRepo());
$VCSClient->update();
