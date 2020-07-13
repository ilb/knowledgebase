<?php

namespace parser;

abstract class Parser {

    /**
     * Возвращает полученный контент страницы
     * @param string $source
     * @return string
     */
    protected function getData($source) {
        $ch = curl_init($source);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $res = curl_exec($ch);
        curl_close($ch);

        if (empty($res)) {
            $res = file_get_contents($source);
        }

        return $res;
    }

}
