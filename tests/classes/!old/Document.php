<?php

class Document {
    /**
     *
     * @var String
     */
    private $id;
    
    /**
     *
     * @var Array CLass Resource
     */
    private $resources = array();
    
    /**
     *
     * @var String
     */
    private $source;
    
    /**
     * 
     * @param String $name
     * @param String $source
     */
    public function __construct($name, $source) {
        $this->id = $name;
        $this->source = $source;
    }
    
    /**
     * Создает классы типа Resource из $source
     * заполняя массив $resources 
     */
    public function createResources() {
        $adapter = new ResourceAdapter($this->source);
        $arrayResources = $adapter->getResources();
        foreach ($arrayResources as $value) {
            $this->resources[] = new Resource($value);
        }
    }
    
    public function getId() {
        return $this->id;
    }


    
}
