<?php

use config\Config;
use repository\Repository;

require_once '../config/bootstrap.php';

if ( $_SERVER['REQUEST_METHOD'] != "POST") {
    header("HTTP/1.0: 400 Bad Request");
    echo "Не верный метод запроса";
    exit(1);
}
$repo = new Repository(Config::getInstance()->connection);


$pars = new \parser\SVNParser($_POST["diff"]);
$result = $pars->getEvent();
$data = $pars->getData();
//$result = $pars->getResource($result, $data);
$result = $pars->merge($result, $data);
unset($data, $pars);
$notify = new \usecase\Notificate($result);
$notify->setRepository($repo);
$notify->execute();