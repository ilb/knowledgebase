<?php


namespace parser;


class SVNParser {
    /**
     * @var string
     */
    private $diff;

    private $reg = "/[A-z]+: ([a-z]+.*xhtml)/u";

    public function __construct($diff) {
        $this->diff = $diff;
    }

    /**
     * Возвращает массив [[ event => Event, elem => Element ], ....]
     * @return array
     */
    public function getEvent() {
        $events = array();
        $result = array();
        preg_match_all($this->reg, $this->diff, $events);
        for ($i = 0; $i < count($events[1]); $i++) {
            $result[]["elem"] = $events[1][$i];
        }
        return $result;
    }

    /**
     * @param $events
     * @param $data
     * @return array
     */
    public function getResource($events, $data) {
        $pars = new ResourceParser();
        for ($i = 0;$i < count($events); $i++) {
            $res = $pars->getResource($data[$i]);
            if (count($res) == 0) {
                continue;
            }
            $events[$i]["resource"] = $res;
        }
        return $events;
    }

    /**
     * @param $events
     * @param $data
     * @return array
     * @throws \Exception
     */
    public function merge($events, $data) {
        if ( count($events) != count($data)) {
            $data = array_slice($data, 0, count($events));
        }
        for ($i = 0;$i < count($events); $i++) {
            $events[$i]["data"] = $data[$i];
        }
        return $events;
    }

    /**
     * Возвращает массив данных изменений
     * @return array
     */
    public function getData() {
        $result = array();
        $delimeter = preg_match_all("/[=]+/", $this->diff, $math);
        $delimeter = $math[0][0];
        $arr = explode(
            $delimeter,
            $this->diff
        );
        $arr = array_slice($arr, 1);
        foreach ($arr as $value) {
            $a = array();
            preg_match_all($this->reg, $value, $a);
            $result[] = count($a[0]) != 0 ? explode($a[0][0], $value)[0] : $value;
        }
        return $result;
    }
}