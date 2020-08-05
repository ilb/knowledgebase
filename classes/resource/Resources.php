<?php


namespace resource;


use parser\ResourceParser;

class Resources {

    private $resources = [];


    public function createResource($source, $nameDocument) {
        $keywords = [];
        $resourceParser = new ResourceParser();
        $rawResources = $resourceParser->getResource($source);
        foreach ($rawResources as $rawResource) {
            $this->resources[] = new Resource(
                $rawResource['name'],
                $nameDocument . "#" . $rawResource['tag']
            );
            $keywords[] = $rawResource['tag'];
        }
        return $keywords;
    }

    public function getResource() {
        return $this->resources;
    }

    public function searchByTag($tagResource) {
        foreach ($this->resources as $resource) {
            if ($resource->getTag() == $tagResource) {
                return $resource;
            }
        }
    }

}