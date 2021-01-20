<?php

/**
 * Поиск по документам тут
 */
namespace usecase\document;

use usecase\helper\UseCase;
use requests\Curl;
use parser\DocumentParser;

class DocumentSearch extends UseCase  {

    /**
     * @var string
     */
    private $source;

    /**
     * @var string
     */
    private $keyWord;

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
        $this->keyWord = $keyWord;
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
            $arr = [];
            $curl->setURL(
                $this->source .
                "/_search"
            );
            $data = [
                "query"=> [
                    "match"=> [
                        "content"=> $this->keyWord,
                    ],
                ],
                "highlight"=> [
                      "fragment_size" => 150,
                      "fields"=> [
                           "content"=> [],
                      ],

                ],
            ];
            $curl->setData($data);
            $temp = $curl->getWithData();

            if (isset($temp["error"])) {
                return ["search_element"=> $this->source,"docs" => []];
            }

            if ($temp["took"] == 0) {
                return ["search_element"=> $this->source,"docs" => []];
            }
            $arr["path"] = str_replace(
                    "trunk/docs",
                    "knowledgebasedoc",
                    trim($temp["hits"]["hits"][0]["_source"]["path"]["virtual"], "/")
            );
            if (isset($temp["hits"]["hits"][0]["_source"]["meta"]["title"])) {
                $arr["name"] = $temp["hits"]["hits"][0]["_source"]["meta"]["title"];
            } else {
                $arr["name"] = $temp["hits"]["hits"][0]["_source"]["file"]["filename"];
            }
            $arr["content"] = implode("<br/>", $temp["hits"]["hits"][0]["highlight"]["content"]);
            $result["doc"] = $arr;
//        }
        return array(
            "search_element"=> $this->keyWord,
            "docs" => $result,
        );
    }
}
