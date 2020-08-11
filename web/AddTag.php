<?php
/**
 * Description Добавляет ключевые слова
 */


use config\Config;
use repository\Repository;
use serialize\Serialize;
use usecase\catalog\GetCatalog;
use usecase\document\DocumentAddTag;

require_once '../config/bootstrap.php';


$repository = new Repository(Config::connect());
if (isset($_POST['document'])) {
    if (empty(trim($_POST['keyWord']))) {
//        $result = "Ключевое слово не может быть пустым";
    } else {
        $res = new DocumentAddTag($_POST['document'], $_POST['keyWord']);
        $res->setRepository($repository);
//        $result = "Произошла ошибка";
//        $result = "Ключевое слово добавлено";
        if (!$res->execute()) {
            exit("Все плохо");
        }
    }
}

$documentList = new GetCatalog("../web/index.html");
$documentList->setRepository($repository);
$catalog = $documentList->execute();
$serialize = new Serialize();
$xml = $serialize->objToXMLandXSL($catalog, "stylesheets/AddTag/AddTag.xsl");
header("Content-type: text/xml");
echo $xml;
