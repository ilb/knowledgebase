<?php

namespace parser;

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
        $results = [];
        $files = scandir($source);
        foreach ($files as $file) {
            if (is_file($source . "/" . $file)) {
                $results[] = array(
                    "name" => $file,
                    "source" => $source . "/" . $file,
                );
            }
        }
        return $results;
    }

}
