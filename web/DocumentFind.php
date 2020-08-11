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
    $repository = new Repository(Config::connect());
    $df = new DocumentSearch("../web/index.html", $_GET['keyWord']);
    $df->setRepository($repository);
    $response = $df->execute();
    $serialize = new Serialize();
    $xml = $serialize->objToXMLandXSL($response, "stylesheets/DocumentList/DocumentList.xsl");
    header("Content-type: text/xml");
    echo $xml;
} else {
    header("Location: DocumentList.php");
}
