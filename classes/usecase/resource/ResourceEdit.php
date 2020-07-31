<?php

/*
 * При редактировании рессурса
 */

namespace usecase\resource;

use usecase\helper\UseCase;


class ResourceEdit extends UseCase {
    
    /**
     * @var string
     */
    private $nameResource;

    /**
     * @var string
     */
    private $content;
    
    /**
     * @param string $nameResource
     */
    public function __construct($nameResource, $content) {
        $this->nameResource = $nameResource;
        $this->content = $content;
    }

    public function execute() {
        $documentName = explode("#", $this->nameResource)[0];
        $nameResource = explode("#", $this->nameResource)[1];
        $this->repository->editResource($documentName, $nameResource, $this->content);
    }
    
}
