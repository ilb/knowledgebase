<?php
/**
 * Description Меняет ссылку документа
 */

use config\Config;
use repository\Repository;
use serialize\Serialize;
use usecase\catalog\GetCatalog;

require_once '../config/bootstrap.php';

// Нужно переделать БД чтобы ссылка на документ менялась с сылкой на ресурс
$repository = new Repository(Config::connect());
$documentList = new GetCatalog("../web/index.html");
$documentList->setRepository($repository);
$catalog = $documentList->execute();
header("Content-type: text/xml");
$serialize = new Serialize();
$xml = $serialize->objToXMLandXSL($catalog, "stylesheets/ChangeDocument/ChangeDocument.xsl");
echo $xml;