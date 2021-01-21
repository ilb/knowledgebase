<?php
namespace usecase\document;

use usecase\helper\UseCase;
use documentpresenter\DocumentPresenterFactory;

class ViewDocument extends UseCase {
    
    /**
     *
     * @var string
     */
    private $filePath;
    
    public function __construct($path) {
        $this->filePath = $path;
    }
    
    /**
     * 
     * @return \documentpresenter\DocumentPresenter     
     */
    public function execute() {
        $mimeType = new \Mime_Type();
        $mime = $mimeType->getTypeByContentAndExt($this->filePath,  pathinfo($this->filePath, PATHINFO_EXTENSION));
        $documentPrFactory = new DocumentPresenterFactory();
        return array(
            "mime_type" => $mime,
            "content" => $documentPrFactory->getDocumentPresenter($data["mime_type"])
        );
    }
}