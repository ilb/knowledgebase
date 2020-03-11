<?php

namespace subscription;

use elements\Document;
use elements\Resource;

class Subscriptions {
    private $subscribtions= array();
    
    public function __construct() {
        
    }
    
    public function foundSubscription($changeElement) {
        $foundSubscription = array();        
        foreach ($this->subscribtions as $element) {
            if (!$this->isClass($element->getElement(), $changeElement)) {
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
