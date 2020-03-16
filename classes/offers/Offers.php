<?php

namespace offers;

class Offers {
    
     /**
     *
     * @var array \offers\Offer
     */
    private $offers = array();
    
    /**
     * @param \elements\Element $element
     * @param \user\User $user
     */
    public function createOffer($link, $user) {
        $this->offers[] = new \offers\Offer($link, $user);
    }    
    
    /**
     * 
     * @return array \offers\Offers
     */
    public function getOffers() {
        return $this->offers;
    }
    
    /**
     * Нужно знать еще ссылку рессурса
     * @return \offers\Offer
     */
    public function getOfferByUser($userName, $link) {
        foreach ($this->offers as $offer) {
            $offerUser = $offer->getUser()->getLogin();
            if ($offerUser == $userName && $link == $offer->getLink()) {
                return $offer;
            }
        }
    }
    
    /**
     * Принимает корректировку в статью
     * @param string $userName
     * @param string $link
     */
    public function acceptOffer($userName, $link) {
        $offer = $this->getOfferByUser($userName, $link);
        $offer->setPublished(true);
    }
}

