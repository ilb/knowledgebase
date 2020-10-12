<?php
/*
 * Description получать информацию о принятых/одобренных его предложениях по корректировке или дополнении материалов. Пока все плохо
 */

use config\Config;
use repository\Repository;
use serialize\Serialize;
use usecase\notify\GetNotificate;

require_once '../config/bootstrap.php';

$repository = new Repository(Config::getInstance()->connection);
$notificate = new GetNotificate(Config::getInstance()->login);
$notificate->setRepository($repository);
$res = $notificate->execute();
$serialize = new Serialize();
$xml = $serialize->arrToXMLandXSL($res, "stylesheets/Notificate/Notificate.xsl");
//echo $xml;
XML_Output::tryHTML($xml,TRUE);
