<?php

use catalog\Catalog;
use PHPUnit\Framework\TestCase;

class CatalogTest extends TestCase {

    protected $catalog;
    protected $docs;

    public function setUp() {
        $this->catalog = new Catalog("/var/apps/knowledgebase/docs");
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
                [11, 0], [4, 1], [7, 2], [21, 3], [9, 4], [8, 5],
                [1, 6], [5, 7], [1, 8], [15, 9], [14, 10], [7, 11],
                [29, 12], [39, 13], [7, 14], [2, 15], [12, 16], [5, 17]
        );
    }

}
