<?php

use config\Config;
use repository\Repository;
use serialize\Serialize;
use usecase\offers\GetOfferUser;

require_once '../config/bootstrap.php';

$repository = new Repository(Config::getInstance()->connection);
$serialize = new Serialize();
$offer = new GetOfferUser("User1");
$offer->setRepository($repository);
$report = $serialize->objToArray($offer->execute());
$xml = $serialize->arrToXMLandXSL($report, "stylesheets/UserOffer/UserOffer.xsl");
XML_Output::tryHTML($xml,TRUE);