<?php

/**
 * Поиск по документам тут
 */

namespace usecase\document;

use usecase\helper\UseCase;
use requests\Curl;
use parser\DocumentParser;

class DocumentSearch extends UseCase {

    /**
     * @var string
     */
    private $source;

    /**
     * @var string
     */
    private $q;

    /**
     *
     * @var string
     */
    private $dir;

    /**
     * @param string $source
     * @param string $keyWord
     */
    public function __construct($dir, $source, $keyWord) {
        $this->source = $source;
        $this->q = $keyWord;
        $this->dir = $dir;
    }

    /**
     * ВОзвращает массив найденных ресурсов и ссылки на них
     * @return \response\Response
     */
    public function execute() {
        $result = [];
//        $pars = new DocumentParser();
        //$repos = $pars->getRepos($this->dir); было для поиска по репозиториям
        $curl = new Curl("");
//        foreach ($repos as $repo) {
        $curl->setURL(
                $this->source .
                "/_search"
        );
        $data = [
            "query" => [
                "match" => [
                    "content" => $this->q,
                ],
            ],
            "highlight" => [
                "fragment_size" => 150,
                "fields" => [
                    "content" => [],
                ],
            ],
        ];
        $curl->setData($data);
        $temp = $curl->getWithData();

        if (isset($temp["error"])) {
            return ["search_element" => $this->q, "docs" => []];
        }

        if ($temp["took"] == 0) {
            return ["search_element" => $this->source, "docs" => []];
        }
//            echo "<pre>";            
//            print_r($temp);
//            echo "</pre>";

        foreach ($temp["hits"]["hits"] as $key => $element) {
            $arr = [];
            $arr["path"] = str_replace(
                    "trunk/docs",
                    "knowledgebasedoc",
                    trim($element["_source"]["path"]["virtual"], "/")
            );
            if (isset($element["_source"]["meta"]["title"])) {
                $arr["name"] = $element["_source"]["meta"]["title"];
            } else {
                $arr["name"] = $element["_source"]["file"]["filename"];
            }
            $arr["content"] = implode("<br/>", $element["highlight"]["content"]);
            $result["doc"][] = $arr;
        }
//            exit(0);
//        }
        return array(
            "search_element" => $this->q,
            "docs" => $result,
        );
    }

}
