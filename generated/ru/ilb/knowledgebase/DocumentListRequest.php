<?php

namespace ru\ilb\knowledgebase;

class DocumentListRequest extends \Happymeal\Port\Adaptor\Data\XML\Schema\AnyComplexType {

    const NS = "";
    const ROOT = "DocumentListRequest";
    const PREF = NULL;

    /**
     * @maxOccurs 1 .
     * @var ru\ilb\knowledgebase\\DocumentListRequest\LoginRequest
     */
    protected $LoginRequest = null;

    /**
     * @maxOccurs 1 .
     * @var ru\ilb\knowledgebase\\DocumentListRequest\SearchDocument
     */
    protected $SearchDocument = null;

    public function __construct() {
        parent::__construct();
        $this->_properties["LoginRequest"] = array(
            "prop" => "LoginRequest",
            "ns" => "",
            "minOccurs" => 1,
            "text" => $this->LoginRequest
        );
        $this->_properties["SearchDocument"] = array(
            "prop" => "SearchDocument",
            "ns" => "",
            "minOccurs" => 1,
            "text" => $this->SearchDocument
        );
    }

    /**
     * @param ru\ilb\knowledgebase\\DocumentListRequest\LoginRequest $val
     */
    public function setLoginRequest(\ru\ilb\knowledgebase\\DocumentListRequest\LoginRequest $val) {
        $this->LoginRequest = $val;
        $this->_properties["LoginRequest"]["text"] = $val;
        return $this;
    }

    /**
     * @param ru\ilb\knowledgebase\\DocumentListRequest\SearchDocument $val
     */
    public function setSearchDocument(\ru\ilb\knowledgebase\\DocumentListRequest\SearchDocument $val) {
        $this->SearchDocument = $val;
        $this->_properties["SearchDocument"]["text"] = $val;
        return $this;
    }

    /**
     * @return ru\ilb\knowledgebase\\DocumentListRequest\LoginRequest
     */
    public function getLoginRequest() {
        return $this->LoginRequest;
    }

    /**
     * @return ru\ilb\knowledgebase\\DocumentListRequest\SearchDocument
     */
    public function getSearchDocument() {
        return $this->SearchDocument;
    }

    public function toXmlStr($xmlns = self::NS, $xmlname = self::ROOT) {
        return parent::toXmlStr($xmlns, $xmlname);
    }

    /**
     * Вывод в XMLWriter
     * @param XMLWriter $xw
     * @param string $xmlname Имя корневого узла
     * @param string $xmlns Пространство имен
     * @param int $mode
     */
    public function toXmlWriter(\XMLWriter &$xw, $xmlname = self::ROOT, $xmlns = self::NS, $mode = \Adaptor_XML::ELEMENT) {
        if ($mode & \Adaptor_XML::STARTELEMENT) {
            $xw->startElementNS(NULL, $xmlname, $xmlns);
        }
        $this->attributesToXmlWriter($xw, $xmlname, $xmlns);
        $this->elementsToXmlWriter($xw, $xmlname, $xmlns);
        if ($mode & \Adaptor_XML::ENDELEMENT) {
            $xw->endElement();
        }
    }

    /**
     * Вывод атрибутов в \XMLWriter
     * @param \XMLWriter $xw
     * @param string $xmlname Имя корневого узла
     * @param string $xmlns Пространство имен
     */
    protected function attributesToXmlWriter(\XMLWriter &$xw, $xmlname = self::ROOT, $xmlns = self::NS) {
        parent::attributesToXmlWriter($xw, $xmlname, $xmlns);
    }

    /**
     * Вывод элементов в \XMLWriter
     * @param \XMLWriter $xw
     * @param string $xmlname Имя корневого узла
     * @param string $xmlns Пространство имен
     */
    protected function elementsToXmlWriter(\XMLWriter &$xw, $xmlname = self::ROOT, $xmlns = self::NS) {
        parent::elementsToXmlWriter($xw, $xmlname, $xmlns);
        $prop = $this->getLoginRequest();
        if ($prop !== NULL) {
            $prop->toXmlWriter($xw);
        }
        $prop = $this->getSearchDocument();
        if ($prop !== NULL) {
            $prop->toXmlWriter($xw);
        }
    }

    /**
     * Чтение атрибутов из \XMLReader
     * @param \XMLReader $xr
     */
    public function attributesFromXmlReader(\XMLReader &$xr) {
        parent::attributesFromXmlReader($xr);
    }

    /**
     * Чтение элементов из \XMLReader
     * @param \XMLReader $xr
     */
    public function elementsFromXmlReader(\XMLReader &$xr) {
        switch ($xr->localName) {
            case "LoginRequest":
                $LoginRequest = \Adaptor_Bindings::create("\\ru\\ilb\\knowledgebase\\\\DocumentListRequest\\LoginRequest");
                $this->setLoginRequest($LoginRequest->fromXmlReader($xr));
                break;
            case "SearchDocument":
                $SearchDocument = \Adaptor_Bindings::create("\\ru\\ilb\\knowledgebase\\\\DocumentListRequest\\SearchDocument");
                $this->setSearchDocument($SearchDocument->fromXmlReader($xr));
                break;
            default:
                parent::elementsFromXmlReader($xr);
        }
    }

    /**
     * Чтение данных JSON объекта, результата работы json_decode,
     * в объект
     * @param mixed array | stdObject
     *
     */
    public function fromJSON($arg) {
        parent::fromJSON($arg);
        $props = [];
        if (is_array($arg)) {
            $props = $arg;
        } elseif (is_object($arg)) {
            foreach ($arg as $k => $v) {
                $props[$k] = $v;
            }
        }
        if (isset($props["LoginRequest"])) {
            $LoginRequest = \Adaptor_Bindings::create("\\ru\\ilb\\knowledgebase\\\\DocumentListRequest\\LoginRequest");
            $LoginRequest->fromJSON($props["LoginRequest"]);
            $this->setLoginRequest($LoginRequest);
        }
        if (isset($props["SearchDocument"])) {
            $SearchDocument = \Adaptor_Bindings::create("\\ru\\ilb\\knowledgebase\\\\DocumentListRequest\\SearchDocument");
            $SearchDocument->fromJSON($props["SearchDocument"]);
            $this->setSearchDocument($SearchDocument);
        }
    }

    /**
     * Чтение данных массива
     * в объект
     * @param Array $row
     *
     */
    public function fromArray($row) {
        if (isset($row["LoginRequest"])) {
            $LoginRequest = \Adaptor_Bindings::create("\\ru\\ilb\\knowledgebase\\\\DocumentListRequest\\LoginRequest");
            $LoginRequest->fromArray($row["LoginRequest"]);
            $this->setLoginRequest($LoginRequest);
        }
        if (isset($row["SearchDocument"])) {
            $SearchDocument = \Adaptor_Bindings::create("\\ru\\ilb\\knowledgebase\\\\DocumentListRequest\\SearchDocument");
            $SearchDocument->fromArray($row["SearchDocument"]);
            $this->setSearchDocument($SearchDocument);
        }
    }

}
