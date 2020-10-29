<?php

/* 
 * Создание документа
 */

namespace usecase\document;

use config\Config;
use usecase\helper\UseCase;
use vcsclient\VCSClientFactory;

class DocumentCreate extends UseCase  {
    
    /**
     * @var string
     */
    private $nameDocument;

    /**
     * @param string $nameDocument
     * @param string $source
     */
    public function __construct($nameDocument) {
        $this->nameDocument = $nameDocument;
    }
    
    public function execute() {
        $res = array();
        $path = Config::getInstance()->filespath;
        $empty = Config::getInstance()->default;
        if (file_exists($path. "/" .$this->nameDocument)) {
            return [
                "error" => "Файл уже существует",
                "path" => $path. "/" .$this->nameDocument,
            ];
        }
        if (!copy($path. "/" . $empty, $path . "/" . $this->nameDocument)){
            return ["error" => "Ошибка при копировании"];
        } else {
            $res["result"] = "Файл успешно создан";
        }
        $repo = explode("/", $this->nameDocument);
        if (count($repo) > 1) {
            $repo = $repo[0];
        } else {
            $repo = "";
        }
        $this->addVCS($this->nameDocument, $repo);
        $this->repository->addDocument($this->nameDocument);
        return  $res;
    }

    /**
     * Выполняет команду добавления
     * @param $path string
     * @param $repo
     * @throws \Exception
     */
    private function addVCS($path, $repo) {
        $VCSClientFactory = new VCSClientFactory(Config::getInstance()->filespath);
        $VCSClient = $VCSClientFactory->getVCSClient($repo);
        $VCSClient->add($path);
        $VCSClient->commit("Update file $path");
    }
}

