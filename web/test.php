<?php
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use usecase\catalog\GetCatalog;

require_once '../config/bootstrap.php';

$encoders = [new XmlEncoder(), new JsonEncoder()];
$normalizers = [new ObjectNormalizer()];

$serializer = new Serializer($normalizers, $encoders);

$documentList = new GetCatalog("../web/index.html");
$catalog = $documentList->execute();
foreach ($catalog->getDocuments() as $document) :
    $document->createResources();
endforeach;
// сериализованный класс
// ради теста пока будет тут
// сразу как получится вынесу в отдельную папку
class Response {
    private $elements;

    function __construct($elem) {
        $this->elements = $elem;
    }

    function setElement($elem) {
        $this->elements = $elem;
    }

    function getElements() {
        return $this->elements;
    }

}

$res = new Response($catalog);
$xml = $serializer->serialize($res, "xml");

header("Content-type: text/xml");
// это костыль я просто пока не разобрался как в сериализаторе прикрепить стили сразу
$arr = explode("\n", $xml);
$xml = $arr[0] . '<?xml-stylesheet type="text/xsl" href="stylesheets/DocumentList/DocumentList.xsl"?>'
    . $arr[1];
//echo  $xml ;

//XML_Output::tryHTML($xml);
XML_Output::tryHTML($xml,TRUE);

/**
 * TODO:
 *  Реализовать класс по сериализации в json, xml, xhtml
 *  + Прикрепить стили
 */