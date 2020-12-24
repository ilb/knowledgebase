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
        foreach ($repos as $repo) {
            $arr = [];
            $curl->setURL(
                $this->source .
                "/$repo/svndocument/_search?pretty&q=" . 
                urlencode($this->keyWord)
            );
            $temp = $curl->getWithJSON();
            $arr["path"] = str_replace(
                    "trunk/docs", 
                    "knowledgebasedoc", 
                    trim($temp["hits"]["hits"][0]["_source"]["fullname"], "/")
            );
            $arr["name"] = $temp["hits"]["hits"][0]["_source"]["name"];
            $result["doc"] = $arr;
        }
        return array(
            "docs" => $result,
        );
    }
}
