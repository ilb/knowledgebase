<?php

namespace parser;

class ResourceParser extends Parser {

    /**
     * 
     * @param string $source
     * @return array
     */
    public function getResource($source) {
        $saitData = $this->getData($source);
        $results = [];
        $tags = array();
        $attribute = array();
        preg_match_all("/<a.*>(.+?)<\/a>/u", $saitData, $tags);
        for ($i = 0; $i < count($tags[0]); $i++) {
            preg_match_all("/href=\"#(.+?)\"/u", $tags[0][$i], $attribute);
            if (empty($attribute[1])) {
                continue;
            }
            $results[] = array(
                "name" => $tags[1][$i],
                "tag" => $attribute[1][0]
            );
        }
        return $results;
    }

}
