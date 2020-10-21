<?php


require_once '../config/bootstrap.php';

$dirs = new \usecase\catalog\GetOnlyDir();
$dirs = $dirs->execute();
$ser = new \serialize\Serialize();
$xml = $ser->arrToXMLandXSL($dirs, "stylesheets/CreateDocument/CreateDocument.xsl");
XML_Output::tryHTML($xml,TRUE);
