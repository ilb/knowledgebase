<?php

class ObserverTest extends \PHPUnit_Framework_TestCase {
    
    public function testSubscription() {
        $s = new \subscription\Subscriptions();
        $c = new \elements\Catalog($s);
        var_dump($c->editDoc("Doc_2"));
        $this->assertEquals(["Уведомлен пользователь: User_2",
            "Уведомлен пользователь: User_5"], $c->editDoc("Doc_2"));
        $this->assertTrue(true);
    }
}
