<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace usecase\mime;

use usecase\helper\UseCase;

/**
 * Description of GetMimeType
 *
 * @author gudov
 */
class GetMimeType extends UseCase {
    
    /**
     *
     * @var string
     */
    private $filePath;
    
    public function __construct($path) {
        $this->path = $path;
    }
    
    public function execute() {
        $mimeType = new Mime_Type();
        return $mimeType->getTypeByContentAndExt($this->filePath,  pathinfo($this->filePath, PATHINFO_EXTENSION));
    }

}
