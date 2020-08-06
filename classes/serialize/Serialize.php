<?php


namespace serialize;


use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class Serialize {

    /**
     * @var Serializer
     */
    private $serializer;

    public function __construct() {
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $this->serializer = new Serializer($normalizers, $encoders);
    }


    /**
     * Возвращает готовую xml строку
     * @param $response \response\Response
     */
    public function objToXML($response) {
        return $this->serializer->serialize($response, "xml");
    }

    /**
     * Возвращает готовую xml строку с xsl стилями
     * @param $response \response\Response класс для сериализации
     * @param $path string Путь до файла XSL
     */
    public function objToXMLandXSL($response, $path) {
        $xml = $this->serializer->serialize($response, "xml");
        // до сих пор остается костыль
        $arr = explode("\n", $xml);
        $xml = $arr[0] . "<?xml-stylesheet type=\"text/xsl\" href=\"" . $path . "\"?>" . $arr[1];
        return $xml;
    }

    /**
     * Возвращает готовую xml строку с xsl стилями
     * @param $response array массив для сериализации
     * @param $path string Путь до файла XSL
     */
    public function arrToXMLandXSL($response, $path) {
        $xml = $this->serializer->encode($response, "xml");
        // до сих пор остается костыль
        $arr = explode("\n", $xml);
        $xml = $arr[0] . "<?xml-stylesheet type=\"text/xsl\" href=\"" . $path . "\"?>" . $arr[1];
        return $xml;
    }

    /**
     * Возвращает готовую xml строку
     * @param $response array массив для сериализации
     */
    public function arrToXML($response) {
        return $this->serializer->encode($response, "xml");
    }


    /**
     * @param $response \response\Response
     */
    public function objToJSON($response) {
        return $this->serializer->serialize($response, "json");
    }

}