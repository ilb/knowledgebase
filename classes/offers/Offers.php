<?php

namespace offers;

class Offers {
    
     /**
     *
     * @var array \offers\Offer
     */
    private $offers = array();
    
    /**
     * 
     * @param \elements\Element $element
     * @param \user\User $user
     */
    public function offer($element, $user, $text) {
        $this->offers[] = new Offer($element, $user, $text);
    }    
    
    /**
     * 
     * @return array \offers\Offers
     */
    public function getOffers() {
        return $this->offers;
    }
    
    /**
     * @return \offers\Offer
     */
    public function getOfferByUser($user) {
        foreach ($this->offers as $offer) {
            if ($offer->getUser()->getLogin() == $user->getLogin()) {
                return $offer;
            }
        }
    }
    
}

