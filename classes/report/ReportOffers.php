<?php

namespace report;

class ReportOffers extends Report {
    
    /**
     *
     * @var \offers\Offers
     */
    private $offers;
    
    /**
     * создает отчет по не прочитанным подпискам
     * Создает xml документ 
     */
    public function generateReportAllOffers() {
        $arrayResponse = [];
        foreach ($this->users as $user) {
            $materials = $this->offers->getOffersByUser($user->getLogin());
            if (!empty($materials)) {
                $arrayResponse['Offers'][] = $materials;
            }
        }
        return $this->serializer->encode($arrayResponse, "xml", $this->context);
    }
    
    /**
     * @return \offers\Offers
     */
    public function getOffers() {
        return $this->offers;
    }

    /**
     * @param \offers\Offers $offers
     */
    public function setOffers($offers) {
        $this->offers = $offers;
    }
    
}
