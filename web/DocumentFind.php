<?php
/**
 * Description Выводит список всех найденных ресурсов по ключевому слову
 */

use config\Config;
use repository\Repository;
use serialize\Serialize;
use usecase\document\DocumentSearch;

require_once '../config/bootstrap.php';

if (isset($_GET['keyWord'])) {
    $repository = new Repository(Config::getInstance()->connection);
    $df = new DocumentSearch(Config::getInstance()->filespath, $_GET['keyWord']);
    $df->setRepository($repository);
    $response = $df->execute();
    $serialize = new Serialize();
    $xml = $serialize->objToXMLandXSL($response, "stylesheets/DocumentList/DocumentList.xsl");
    XML_Output::tryHTML($xml,TRUE);
} else {
    header("Location: DocumentList.php");
}
