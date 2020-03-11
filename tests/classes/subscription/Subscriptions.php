<?php

namespace subscription;

use elements\Document;
use elements\Resource;

class Subscriptions {
    private $subscribtions= array();
    
    public function __construct() {
        for ($i = 0; $i < 5; $i++) {
            $u = new \user\User("User_" . $i);           
            if ($i % 2 == 0) {
                 
                $e = new Document("Doc_" . $i, $this);
            } else {
                $e = new Resource("Res_" . $i, $this);
            }
            
            $this->subscribtions[] = new \subscription\Subscription($u, $e);
        }
        $u = new \user\User("User_5"); 
        $e = new Document("Doc_2", $this);
        $this->subscribtions[] = new \subscription\Subscription($u, $e);
    }
    
    public function foundSubscription($changeElement) {
        $foundSubscription = array();        
        foreach ($this->subscribtions as $element) {
            if (!$element->getElement() instanceof $changeElement) {
                continue;
            }
            if ($element->getElement()->getUnicalName() == $changeElement->getUnicalName()) {
                $foundSubscription[] = $element;
            }
        }
        return $foundSubscription;
    }
    
    private function isClass($obj1, $obj2) {
        return get_class($obj1) == get_class($obj2);
    }
    
}
