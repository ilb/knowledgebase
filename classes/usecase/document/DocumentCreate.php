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
            $res["result"] = "Файл успешно создан";
        }
        $this->repository->addDocument($this->nameDocument);
        return  $res;
    }

}

