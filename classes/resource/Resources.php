<?php


namespace resource;


use config\Config;
use parser\ResourceParser;

class Resources {

    private $resources = [];

    public function addResource($nameDocument, $name, $tag) {
        $this->resources[] = new Resource($name,$nameDocument . "#" . $tag);
    }

    public function createResource($source, $nameDocument) {
        $resourceParser = new ResourceParser();
        $rawResources = $resourceParser->getResource($source);
        $repo = new \repository\Repository(Config::getInstance()->connection);
        foreach ($rawResources as $rawResource) {
            if (!$repo->documentIsset($nameDocument . "#" . $rawResource['tag'])) {
                $repo->addRessource($nameDocument . "#" . $rawResource['tag']);
            }
            $this->resources[] = new Resource(
                $rawResource['name'],
                $nameDocument . "#" . $rawResource['tag']
            );
        }
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