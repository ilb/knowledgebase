<?php


use config\Config;
use repository\Repository;
use ru\ilb\knowledgebase\AddDocument;
use usecase\document\DocumentCreate;

require_once '../config/bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] != "POST") {
    header("HTTP/1.0: 400 Bad Request");
    echo "Не верный метод запроса";
    exit(1);
}
$repo = new Repository(Config::getInstance()->connection);
$hreq = new HTTP_Request2Xml("schemas/command.xsd", null, "AddDocument");
$req = new AddDocument();
if (!$hreq->isEmpty()) {
    $hreq->validate();
    $req->fromXmlStr($hreq->getAsXML());
}

// Не знаю что делать с картинками
if (isset($_FILES["image"])) {
    $photo = file_get_contents($_FILES["image"]["tmp_name"]);
    $base64 = 'data:image/' . $_FILES["image"]["name"] . ';base64,' . base64_encode($photo);
}
if ($req->getName() == "") {
    header("HTTP/1.0: 409 Error");
    echo json_encode(["error"=>"Пустое имя", "post" => file_get_contents("php://input")], JSON_UNESCAPED_UNICODE);
    exit();
}
$createDoc = new DocumentCreate($req->getName());
$createDoc->setRepository($repo);
$response = $createDoc->execute();
if (isset($response["error"])) {
    header("HTTP/1.0: 409 Error");
} else {
    header("HTTP/1.0: 201 Created");
}
echo json_encode($response, JSON_UNESCAPED_UNICODE);
