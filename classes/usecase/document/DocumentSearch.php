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
        $pars = new DocumentParser();
        $repos = $pars->getRepos($this->dir);
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
                      "fields"=> [
                           "content"=> [],
                      ],

                ],
            ];
            $curl->setData($data);
            $temp = $curl->getWithData();
            if ($temp["hits"]["total"] == 0) {
                return ["docs" => []]; 
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
            $arr["content"] = $temp["hits"]["hits"][0]["highlight"]["content"][0];
            $result["doc"] = $arr;
//        }
        return array(
            "docs" => $result,
        );
    }
}
