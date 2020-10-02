<?php

namespace parser;

class ResourceParser extends Parser {

    /**
     * 
     * @param string $source
     * @return array
     */
    public function getResource($source) {
        if (file_exists($source)) {
            $saitData = $this->getData($source);
        } else {
            $saitData = $source;
        }
        $results = [];
        $tags = array();
        $attribute = array();
        preg_match_all("/<a.*>(.+?)<\/a>/u", $saitData, $tags);
        for ($i = 0; $i < count($tags[0]); $i++) {
            $flag = true;
            preg_match_all("/href=\"#(.+?)\"/u", $tags[0][$i], $attribute);
            if (empty($attribute[1])) {
                continue;
            }
            $find = array(
                "name" => strtolower($tags[1][$i]),
                "tag" => $attribute[1][0]
            );
            
            foreach ($results as $res) {
                if ($find['tag'] == $res['tag']) {
                    $flag = false;
                    break;
                }
            }
            if ($flag) {
                 $results[] = $find;
            }
        }
        return $results;
    }

}
