<?php
/*
 * Description Формирует отчеты по предложенным изменениям. так же по подпискам
 */

use config\Config;
use repository\Repository;
use ru\ilb\knowledgebase\ReportList;
use serialize\Serialize;
use usecase\report\Report;

require_once '../config/bootstrap.php';

$repository = new Repository(Config::getInstance()->connection);
$serialize = new Serialize();

$hreq = new HTTP_Request2Xml("schemas/command.xsd", null, "ReportList");
$req = new ReportList();
$reports = [];
if (!$hreq->isEmpty()) {
    $hreq->validate();
    $req->fromXmlStr($hreq->getAsXML());
    $report = new Report($req->getTypeReport());
    $report->setRepository($repository);
    $reports["report"] = $serialize->objToArray($report->execute());
    $reports["type"] = $req->getTypeReport();
}

$xml = $serialize->arrToXMLandXSL($reports, "stylesheets/Reports/ReportList.xsl");
XML_Output::tryHTML($xml,TRUE);
