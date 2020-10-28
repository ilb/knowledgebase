<?php


use serialize\Serialize;
use usecase\catalog\GetOnlyDir;

require_once '../config/bootstrap.php';

$dirs = new GetOnlyDir();
$dirs = $dirs->execute();
$ser = new Serialize();
$xml = $ser->arrToXMLandXSL($dirs, "stylesheets/CreateDocument/CreateDocument.xsl");
XML_Output::tryHTML($xml,TRUE);
