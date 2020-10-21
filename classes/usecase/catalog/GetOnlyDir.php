<?php


namespace usecase\catalog;


use config\Config;
use usecase\helper\UseCase;

class GetOnlyDir extends UseCase {

    public function execute() {
        return $this->scan(Config::getInstance()->filespath, "");
    }

    private function scan($dir, $parent) {
        $results = [];
        $files = scandir($dir);
        foreach ($files as $file) {
            if (is_dir($dir . "/" . $file) && $file[0] != ".") {
                $parentNew = explode(Config::getInstance()->filespath . "/", $dir . "/" . $file)[1];
                $results[] = empty($parent) ? $file : $parent . "/" . $file;
                $results = array_merge($this->scan($dir . "/" . $file, $parentNew), $results);
            }
        }
        return $results;
    }
}