<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace documentpresenter;

/**
 * Description of DocumentPresenterFactory
 *
 * @author gudov
 */
class DocumentPresenterFactory {
    
    /**
     *  Mime type
     * @var string
     */
    private $mimeType;
    
    /**
     * Init
     * @param string $mimeType
     */
    public function __construct($mimeType) {
         $this->mimeType = $mimeType;
    }
    
    /**
     * 
     * @return \documentpresenter\DocumentPresenter
     */
    public function getDocumentPresenter() {
        $splitmimeType = explode( "/", $this->mimeType);
        if ($splitmimeType[0] == "application") {
            return new XhtmlDocumentPresenter();
        }
        return new ImageDocumentPresenter();
    }
}
