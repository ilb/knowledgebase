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
     * 
     * @return \documentpresenter\DocumentPresenter
     */
    public function getDocumentPresenter($mimeType) {
        $splitmimeType = explode( "/", $mimeType);
        if ($splitmimeType[0] == "application") {
            return new XhtmlDocumentPresenter();
        }
        return new DefaultDocumentPresenter();
    }
}
