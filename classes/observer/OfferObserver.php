<?php

namespace observer;

class OfferObserver implements Observer {
    
    public function execute($element, $textNotify, $event) {
        if ($element instanceof \offers\Offer) {
            
        }
    }
}