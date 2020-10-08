<?php

namespace ru\ilb\knowledgebase;

class AddSubscription extends \Happymeal\Port\Adaptor\Data\XML\Schema\AnyComplexType {

    const NS = "";
    const ROOT = "AddSubscription";
    const PREF = NULL;

    /**
     * @maxOccurs 1 .
     * @var \String
     */
    protected $Name = null;

    /**
     * @maxOccurs 1 .
     * @var \String
     */
    protected $Document = null;

    /**
     * @maxOccurs 1 .
     * @var \String
     */
    protected $Group = null;

    /**
     * @maxOccurs 1 .
     * @var \String
     */
    protected $Tag = null;

    public function __construct() {
        parent::__construct();
        $this->_properties["name"] = array(
            "prop" => "Name",
            "ns" => "",
            "minOccurs" => 1,
            "text" => $this->Name
        );
        $this->_properties["document"] = array(
            "prop" => "Document",
            "ns" => "",
            "minOccurs" => 1,
            "text" => $this->Document
        );
        $this->_properties["group"] = array(
            "prop" => "Group",
            "ns" => "",
            "minOccurs" => 0,
            "text" => $this->Group
        );
        $this->_properties["tag"] = array(
            "prop" => "Tag",
            "ns" => "",
            "minOccurs" => 1,
            "text" => $this->Tag
        );
    }

    /**
     * @param \String $val
     */
    public function setName($val) {
        $this->Name = $val;
        $this->_properties["name"]["text"] = $val;
        return $this;
    }

    /**
     * @param \String $val
     */
    public function setDocument($val) {
        $this->Document = $val;
        $this->_properties["document"]["text"] = $val;
        return $this;
    }

    /**
     * @param \String $val
     */
    public function setGroup($val) {
        $this->Group = $val;
        $this->_properties["group"]["text"] = $val;
        return $this;
    }

    /**
     * @param \String $val
     */
    public function setTag($val) {
        $this->Tag = $val;
        $this->_properties["tag"]["text"] = $val;
        return $this;
    }

    /**
     * @return \String
     */
    public function getName() {
        return $this->Name;
    }

    /**
     * @return \String
     */
    public function getDocument() {
        return $this->Document;
    }

    /**
     * @return \String
     */
    public function getGroup() {
        return $this->Group;
    }

    /**
     * @return \String
     */
    public function getTag() {
        return $this->Tag;
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
        $prop = $this->getName();
        if ($prop !== NULL) {
            $xw->writeElement('name', $prop);
        }
        $prop = $this->getDocument();
        if ($prop !== NULL) {
            $xw->writeElement('document', $prop);
        }
        $prop = $this->getGroup();
        if ($prop !== NULL) {
            $xw->writeElement('group', $prop);
        }
        $prop = $this->getTag();
        if ($prop !== NULL) {
            $xw->writeElement('tag', $prop);
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
            case "name":
                $this->setName($xr->readString());
                break;
            case "document":
                $this->setDocument($xr->readString());
                break;
            case "group":
                $this->setGroup($xr->readString());
                break;
            case "tag":
                $this->setTag($xr->readString());
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
        if (isset($props["name"])) {
            $this->setName($props["name"]);
        }
        if (isset($props["document"])) {
            $this->setDocument($props["document"]);
        }
        if (isset($props["group"])) {
            $this->setGroup($props["group"]);
        }
        if (isset($props["tag"])) {
            $this->setTag($props["tag"]);
        }
    }

    /**
     * Чтение данных массива
     * в объект
     * @param Array $row
     *
     */
    public function fromArray($row) {
        if (isset($row["name"])) {
            $this->setName($row["name"]);
        }
        if (isset($row["document"])) {
            $this->setDocument($row["document"]);
        }
        if (isset($row["group"])) {
            $this->setGroup($row["group"]);
        }
        if (isset($row["tag"])) {
            $this->setTag($row["tag"]);
        }
    }

}
