<?php

namespace report;

class ReportSubscriptions extends Report {
    
    /**
     * @var \subscription\Subscriptions
     */
    private $subscriptions; 
    
    /**
     * создает отчет по не прочитанным подпискам
     * Создает xml документ 
     */
    public function generateReportAllSubscription() {
        $arrayResponse = [];
        foreach ($this->users as $user) {
            $materials = $this->subscriptions->getSubscriptionByUser($user);
            if (!empty($materials)) {
                $arrayResponse['User'][] = $materials;
            }
        }
        return $this->serializer->encode($arrayResponse, "xml", $this->context);
    }
    
    /**
     * 
     * @param \subscription\Subscriptions $subscriptions
     */
    public function setSubscriptions($subscriptions) {
        $this->subscriptions = $subscriptions;
    }
    
    /**
     * @return \subscription\Subscriptions
     */
    public function getSubscriptions() {
        return $this->subscriptions;
    }

}
