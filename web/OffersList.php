<?php
/*
 * Description Выводит список всех документов и ресурсов предложенных на изменение
 */

use config\Config;
use repository\Repository;
use serialize\Serialize;
use usecase\offers\GetOfferList;

require_once '../config/bootstrap.php';
# TODO: принять предложение
$repository = new Repository(Config::connect());
$offerList = new GetOfferList();
$offerList->setRepository($repository);
$offerList = $offerList->execute();
$serialize = new Serialize();
$xml = $serialize->arrToXMLandXSL($offerList, "stylesheets/OffersList/OffersList.xsl");
XML_Output::tryHTML($xml,TRUE); 
