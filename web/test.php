<?php

use serialize\Serialize;

require_once '../config/bootstrap.php';

$hreq = new HTTP_Request2Xml("schemas/command.xsd", null, "AddTag");
if (!$hreq->isEmpty()) {
    $hreq->validate();
    echo $hreq->getElementByTagName("tag");
}
