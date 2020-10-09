<?php

require_once '../config/bootstrap.php';

$docs = new \parser\DocumentParser();
$docs = $docs->getDocumentsDir(\config\Config::getInstance()->filespath);
$ser = new \serialize\Serialize();
$xml = $ser->arrToXMLandXSL($docs, "stylesheets/Table/Table.xsl");
XML_Output::tryHTML($xml,TRUE);