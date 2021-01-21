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
    $df = new DocumentSearch(Config::getInstance()->filespath, $_SERVER[".apps.elasticsearch.ws"], $_GET['keyWord']);
    $response = $df->execute();
    $serialize = new Serialize();
    $xml = $serialize->arrToXMLandXSL($response, "stylesheets/DocumentList/DocumentSearching.xsl");
    XML_Output::tryHTML($xml,TRUE);
} else {
    header("Location: DocumentList.php");
}
