<?php
/*
 * Description Выводит список всех документов и ресурсов предложенных на изменение
 */

use config\Config;
use repository\Repository;
use serialize\Serialize;
use usecase\offers\GetOfferList;

require_once '../config/bootstrap.php';

$repository = new Repository(Config::connect());
$offerList = new GetOfferList();
$offerList->setRepository($repository);
$offerList = $offerList->execute();
header("Content-type: text/xml");
$serialize = new Serialize();
echo $serialize->arrToXMLandXSL($offerList, "stylesheets/OffersList/OffersList.xsl");
