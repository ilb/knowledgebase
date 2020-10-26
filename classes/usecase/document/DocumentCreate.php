<?php

/* 
 * Создание документа
 */

namespace usecase\document;

use config\Config;
use usecase\helper\UseCase;

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
            //chmod($path . "/" . $this->nameDocument, 0644);
            $res["result"] = "Файл успешно создан";
        }
        // надо какой то обработчик команды придумать
        $this->addSVN($path . "/" . $this->nameDocument);
        $this->repository->addDocument($this->nameDocument);
        return  $res;
    }

    /**
     * Выполняет команду добавления
     * @param $path string
     * @return string
     */
    private function addSVN($path) {
        return exec("./../tools/add_svn.sh " . $path . "Add document: " . $this->nameDocument);
    }
}

