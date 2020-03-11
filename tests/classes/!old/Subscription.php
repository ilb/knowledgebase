<?php

class Subscribtion {
    /**
     *
     * @var Class User object 
     */
    private $user;
    
    /**
     *
     * @var Class Resource object
     */
    private $document;
    
    /**
     * 
     * @param Class $user
     * @param Class $resource
     */
    public function __construct($user, $document) {
        $this->user = $user;
        $this->document = $document;
    }
    
    public function getUser() {
        return $this->user;
    }

    public function getDocument() {
        return $this->document;
    }
    
    public function getDocumentId() {
        return $this->document->getId();
    }


}
