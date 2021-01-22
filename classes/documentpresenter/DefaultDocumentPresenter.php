<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace documentpresenter;

/**
 * Description of ImageDocumentPresenter
 *
 * @author gudov
 */
class DefaultDocumentPresenter implements DocumentPresenter  {
    
    /**
     * 
     * @param string $path
     */
    public function present($path, $doc, $login) {
        return file_get_contents($path . "/" . $doc);
    }
}
