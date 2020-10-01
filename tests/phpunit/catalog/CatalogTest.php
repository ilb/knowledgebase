<?php

use catalog\Catalog;
use PHPUnit\Framework\TestCase;

class CatalogTest extends TestCase {

    protected $catalog;
    protected $docs;

    public function setUp() {
        $this->catalog = new Catalog("/var/apps/knowledgebase");
        $this->catalog->createDocuments();
        $this->docs = $this->catalog->getDocuments();
    }

    public function testCountDocument() {
        $this->assertCount(17, $this->docs);
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
                [11, 0], [4, 1], [7, 2], [21, 3], [11, 4], [8, 5],
                [1, 6], [5, 7], [1, 8], [15, 9], [14, 10], [7, 11],
                [29, 12], [39, 13], [7, 14], [12, 15], [5, 16]
        );
    }

}
