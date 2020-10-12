<?php

namespace parser;

use config\Config;

class DocumentParser extends Parser {

    /**
     * По индекс файлу
     * @param string $source
     * @return array
     */
    public function getDocuments($source) {
        $saitData = $this->getData($source);
        $results = [];
        $tags = array();
        $attribute = array();
        preg_match_all("/<td.+>(.+?)<\/a>/u", $saitData, $tags);
        for ($i = 0; $i < count($tags[0]); $i++) {
            preg_match_all("/href=\"(.+?)\"/u", $tags[0][$i], $attribute);
            if ($tags[1][$i] == "Parent Directory") {
                continue;
            }
            $results[] = array(
                "name" => $tags[1][$i],
                "source" => $attribute[1][0]
            );
        }
        return $results;
    }

    /**
     * Из папки
     * @param $source
     * @return array
     */
    public function getDocumentsDir($source) {
        return $this->scan($source, "");
    }


    public function getDirandDocs($dir) {
        $results = [];
        $files = scandir($dir);
        foreach ($files as $file) {
            if (is_dir($dir . "/" . $file) && $file != "." && $file != ".." && $file[0] != ".") {
                $results[] = [ "name" => $file . "/", "dir" => true ];
            }
            if (is_file($dir . "/" . $file)) {
                $results[] = [ "name" => $file, "dir" => false ];
            }
        }
        return $results;
    }

    private function scan($dir, $parent) {
        $results = [];
        $files = scandir($dir);
        foreach ($files as $file) {
            if (is_dir($dir . "/" . $file) && $file != "." && $file != ".." && $file[0] != ".") {
                $parentNew = explode(Config::getInstance()->filespath . "/", $dir . "/" . $file)[1];
                $results = array_merge($this->scan($dir . "/" . $file, $parentNew), $results);
            }
            if (is_file($dir . "/" . $file)) {
                $results[] = array(
                    "name" => $parent . "/" . $file,
                    "source" => $dir . "/" . $file,
                );
            }
        }
        return $results;
    }

}
