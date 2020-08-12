<?php
require_once '../config/bootstrap.php';

$hreq = new HTTP_Request2Xml("schemas/command.xsd", null, "LoginRequest");
if (!$hreq->isEmpty()) {
    $hreq->validate();
    $xml = $hreq->getAsXML();
}