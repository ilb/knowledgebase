<?php

class ResourceAdapter {
    /**
     *
     * @var Array type String
     */
    private $resource = [];
    
    /**
     *
     * @var String
     */
    private $source;
    
    /**
     * 
     * @param String $source
     */
    public function __construct($source) {
        $this->source = file_get_contents($source);
        if (empty($this->source)) {
            $this->getSource($source);
        }
    }
    
    /**
     * Если не удалось получить контест то вызывается curl
     * @param String $source
     */
    private function getSource($source) {
        $ch = curl_init($source);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result =  curl_exec($ch);
        curl_close($ch);
        $this->source = $result;
    }

    /**
     * Парсит и находит все необходимые рессурсы
     * @param String $tag
     * @param String $attribute
     * @return Array
     */
    public function getResources($tag = "h[0-6]+", $attribute = "id") {
        $tags = preg_match_all("/<".$tag.".*?>/", $this->source, $out, PREG_SET_ORDER);
        foreach ($out as $val) {
            foreach ($val as $val1) {
                $attributes = preg_match_all("/$attribute=[^>]*/", $val1, $outA, PREG_PATTERN_ORDER);
                if (!$attribute) {
                    continue(2);
                }
                $at = explode($attribute . "=\"", $outA[0][0])[1];
                foreach (explode("\"", $at) as $value) {
                    if (!empty($value)) {
                        echo $value . "\r\n";
                        $this->resource[] = $value;
                    }
                }
            }
        }
        return $this->resource;
    }
}
