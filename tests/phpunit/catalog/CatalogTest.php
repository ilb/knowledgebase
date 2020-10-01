<?php

use catalog\Catalog;
use config\Config;
use PHPUnit\Framework\TestCase;

class CatalogTest extends TestCase {

    protected $catalog;
    protected $docs;

    public function setUp() {
        $this->catalog = new Catalog(Config::getInstance()->filespath);
        $this->catalog->createDocuments();
        $this->docs = $this->catalog->getDocuments();
    }

    public function testCountDocument() {
        $this->assertCount(18, $this->docs);
    }

    /**
     * @dataProvider providerRes
     */
    public function testCountResource($result, $index) {
        $this->docs[$index]->createResources();        
        $this->assertCount($result, $this->docs[$index]->getResources()->getResource());
    }

    public function providerRes() {
        return array(
                [0, 0], [0, 1], [0, 2], [0, 3], [0, 4], [11, 5],
                [4, 6], [7, 7], [28, 8], [5, 9], [1, 10], [1, 11],
                [12, 12], [27, 13], [39, 14], [2, 15], [12, 16], [5, 17]
        );
    }

}