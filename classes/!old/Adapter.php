<?php

class Adapter {
    /**
     *
     * @var String
     */
    private $sourse;
    
    /**
     *
     * @var Array Array ( keys name, href )
     */
    private $docs = [];
    
    /**
     * 
     * @param String $sourse
     */
    public function __construct($sourse) {
        $this->sourse = file_get_contents($sourse);

    }
    
    /**
     * Парсит страницу $source и возвращает найденный массив
     * @return Array Array ( keys name, href )
     */
    public function getDocs() {
        $hrefs = explode("<td><a", $this->sourse);
        unset($hrefs[0]);
        foreach ($hrefs as $href) {
            $href = explode("href=\"", $href)[1];
            $hrefFind = explode("\"", $href)[0];
            $href = explode(">", $href)[1];
            $nameFind = explode("</", $href)[0];
            $this->docs[] = array(
                "name" => $nameFind,
                "href" => $hrefFind
            );
        }
        return $this->docs;
    }

}
