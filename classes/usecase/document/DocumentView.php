<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace usecase\document;

use usecase\helper\UseCase;
use documentpresenter\DocumentPresenterFactory;

/**
 * Description of DocumentView
 *
 * @author gudov
 */
class DocumentView extends UseCase  {
       
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
            "content" => $documentPrFactory->getDocumentPresenter($mime)
        );
    }
}
