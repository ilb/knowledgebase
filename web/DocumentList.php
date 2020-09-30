<?php
/**
 * Description Выводит список всех документов и ресурсов
 */

use config\Config;
use serialize\Serialize;
use usecase\catalog\GetCatalog;

require_once '../config/bootstrap.php';

$documentList = new GetCatalog(Config::getInstance()->filespath);
$catalog = $documentList->execute();

$serialize = new Serialize();
$xml = $serialize->objToXMLandXSL($catalog, "stylesheets/DocumentList/DocumentList.xsl");
//header("Content-type: text/xml");
XML_Output::tryHTML($xml,TRUE);
//echo $xml;
