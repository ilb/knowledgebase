<?php

namespace offers;

class Offers {
    
     /**
     *
     * @var array<\offers\Offer>
     */
    private $offers = array();
    
    /**
     * @param string $link
     * @param \user\User $user
     */
    public function createOffer($link, $user,$offerObserver) {
        $this->offers[] = new \offers\Offer($link, $user, $offerObserver);
    }    
    
    /**
     * 
     * @return array<\offers\Offers>
     */
    public function getOffers() {
        return $this->offers;
    }
    
    /**
     * 
     * @param string $userName
     * @param string $link
     * @return \offers\Offer
     */
    public function getOfferByUserLink($userName, $link) {
        foreach ($this->offers as $offer) {
            $offerUser = $offer->getUser()->getLogin();
            if ($offerUser == $userName && $link == $offer->getLink()) {
                return $offer;
            }
        }
    }
    
    /**
     * 
     * @param string $userName
     * @return array<\offers\Offer>
     */
    public function getOffersByUser($userName) {
        $find = [];
        foreach ($this->offers as $offer) {
            $offerUser = $offer->getUser()->getLogin();
            if ($offerUser == $userName) {
                $find[] = $offer;
            }
        }
        return $find;
    }
    
    /**
     * Принимает корректировку в статью
     * @param string $userName
     * @param string $link
     * @param \catalog\Catalog
     */
    public function acceptOffer($userName, $link, $catalog) {
        // nameDoc#resTag
        $arr = explode("#", $link);
        $a = $catalog->getDocumentByName($arr[0]);
        if ($a) {           
            $offer = $this->getOfferByUserLink($userName, $link);
            $offer->setPublished(true);   
            $a = $a->getResourceByTag($arr[1]);
            $a->editResource("");
        }
    }
    
    /**
     * Возвращает не опубдликованные предложения пользователей
     * @return array<\offers\Offer>
     */
    public function getDontPublushedOffer() {
        $result = [];
        foreach ($this->offers as $offer) {
            if (!$offer->getPublished()) {
                $result[] = $offer;
            }
        }
        return $result;
    }
}

