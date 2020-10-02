<?php


namespace parser;


class SVNParser {
    /**
     * @var string
     */
    private $diff;

    private $reg = "/.*:.*\/(.*.xhtml)/u";

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
        for ($i = 0; $i < count($events[0]); $i+=2) {
            $arr = [];
            $arr["event"] = strtolower(explode(":", $events[0][$i])[0]);
            $arr["elem"] = $events[1][$i];
            $result[] = $arr;
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
            throw new \Exception("Ошибка при соединение двух массивов. Разная длина", 789);
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
        $arr = explode(
            "==============================================================================",
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