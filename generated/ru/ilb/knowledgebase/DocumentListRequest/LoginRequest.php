<?php

namespace ru\ilb\knowledgebase\\DocumentListRequest;

class LoginRequest extends \Happymeal\Port\Adaptor\Data\XML\Schema\AnyComplexType {

    const NS = "";
    const ROOT = "LoginRequest";
    const PREF = NULL;

    /**
     * @maxOccurs 1 .
     * @var \String
     */
    protected $Referer = null;

    /**
     * @maxOccurs 1 .
     * @var \Int
     */
    protected $Required = null;

    /**
     * @maxOccurs 1 .
     * @var \String
     */
    protected $LoginName = null;

    /**
     * @maxOccurs 1 .
     * @var \String
     */
    protected $Password = null;

    /**
     * @maxOccurs 1 .
     * @var \String
     */
    protected $OperUniqid = null;

    /**
     * @maxOccurs 1 .
     * @var \String
     */
    protected $CertUniqid = null;

    public function __construct() {
        parent::__construct();
        $this->_properties["referer"] = array(
            "prop" => "Referer",
            "ns" => "",
            "minOccurs" => 1,
            "text" => $this->Referer
        );
        $this->_properties["required"] = array(
            "prop" => "Required",
            "ns" => "",
            "minOccurs" => 1,
            "text" => $this->Required
        );
        $this->_properties["loginName"] = array(
            "prop" => "LoginName",
            "ns" => "",
            "minOccurs" => 0,
            "text" => $this->LoginName
        );
        $this->_properties["password"] = array(
            "prop" => "Password",
            "ns" => "",
            "minOccurs" => 0,
            "text" => $this->Password
        );
        $this->_properties["operUniqid"] = array(
            "prop" => "OperUniqid",
            "ns" => "",
            "minOccurs" => 0,
            "text" => $this->OperUniqid
        );
        $this->_properties["certUniqid"] = array(
            "prop" => "CertUniqid",
            "ns" => "",
            "minOccurs" => 0,
            "text" => $this->CertUniqid
        );
    }

    /**
     * @param \String $val
     */
    public function setReferer($val) {
        $this->Referer = $val;
        $this->_properties["referer"]["text"] = $val;
        return $this;
    }

    /**
     * @param \Int $val
     */
    public function setRequired($val) {
        $this->Required = $val;
        $this->_properties["required"]["text"] = $val;
        return $this;
    }

    /**
     * @param \String $val
     */
    public function setLoginName($val) {
        $this->LoginName = $val;
        $this->_properties["loginName"]["text"] = $val;
        return $this;
    }

    /**
     * @param \String $val
     */
    public function setPassword($val) {
        $this->Password = $val;
        $this->_properties["password"]["text"] = $val;
        return $this;
    }

    /**
     * @param \String $val
     */
    public function setOperUniqid($val) {
        $this->OperUniqid = $val;
        $this->_properties["operUniqid"]["text"] = $val;
        return $this;
    }

    /**
     * @param \String $val
     */
    public function setCertUniqid($val) {
        $this->CertUniqid = $val;
        $this->_properties["certUniqid"]["text"] = $val;
        return $this;
    }

    /**
     * @return \String
     */
    public function getReferer() {
        return $this->Referer;
    }

    /**
     * @return \Int
     */
    public function getRequired() {
        return $this->Required;
    }

    /**
     * @return \String
     */
    public function getLoginName() {
        return $this->LoginName;
    }

    /**
     * @return \String
     */
    public function getPassword() {
        return $this->Password;
    }

    /**
     * @return \String
     */
    public function getOperUniqid() {
        return $this->OperUniqid;
    }

    /**
     * @return \String
     */
    public function getCertUniqid() {
        return $this->CertUniqid;
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
        $prop = $this->getReferer();
        if ($prop !== NULL) {
            $xw->writeElement('referer', $prop);
        }
        $prop = $this->getRequired();
        if ($prop !== NULL) {
            $xw->writeElement('required', $prop);
        }
        $prop = $this->getLoginName();
        if ($prop !== NULL) {
            $xw->writeElement('loginName', $prop);
        }
        $prop = $this->getPassword();
        if ($prop !== NULL) {
            $xw->writeElement('password', $prop);
        }
        $prop = $this->getOperUniqid();
        if ($prop !== NULL) {
            $xw->writeElement('operUniqid', $prop);
        }
        $prop = $this->getCertUniqid();
        if ($prop !== NULL) {
            $xw->writeElement('certUniqid', $prop);
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
            case "referer":
                $this->setReferer($xr->readString());
                break;
            case "required":
                $this->setRequired($xr->readString());
                break;
            case "loginName":
                $this->setLoginName($xr->readString());
                break;
            case "password":
                $this->setPassword($xr->readString());
                break;
            case "operUniqid":
                $this->setOperUniqid($xr->readString());
                break;
            case "certUniqid":
                $this->setCertUniqid($xr->readString());
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
        if (isset($props["referer"])) {
            $this->setReferer($props["referer"]);
        }
        if (isset($props["required"])) {
            $this->setRequired($props["required"]);
        }
        if (isset($props["loginName"])) {
            $this->setLoginName($props["loginName"]);
        }
        if (isset($props["password"])) {
            $this->setPassword($props["password"]);
        }
        if (isset($props["operUniqid"])) {
            $this->setOperUniqid($props["operUniqid"]);
        }
        if (isset($props["certUniqid"])) {
            $this->setCertUniqid($props["certUniqid"]);
        }
    }

    /**
     * Чтение данных массива
     * в объект
     * @param Array $row
     *
     */
    public function fromArray($row) {
        if (isset($row["referer"])) {
            $this->setReferer($row["referer"]);
        }
        if (isset($row["required"])) {
            $this->setRequired($row["required"]);
        }
        if (isset($row["loginName"])) {
            $this->setLoginName($row["loginName"]);
        }
        if (isset($row["password"])) {
            $this->setPassword($row["password"]);
        }
        if (isset($row["operUniqid"])) {
            $this->setOperUniqid($row["operUniqid"]);
        }
        if (isset($row["certUniqid"])) {
            $this->setCertUniqid($row["certUniqid"]);
        }
    }

}
