<?php

namespace contrller;

class MentorController extends UserController {
    
    /**
     *
     * @var \report\ReportSubscriptions
     */
    protected $reportSubscription;
    
    /**
     * @var array \user\User
     */
    protected $users;
    
    /**
     * Добавляет подписку
     * @param string $nameElement
     * @param \user\User $user
     */
    public function addSubscribtion($nameElement, $user) {
        $this->subscriptions->subscribe($nameElement, $user);
    }
    
    public function createReportSubscriptions() {
        $this->reportSubscription = new \report\ReportSubscriptions();
        $this->reportSubscription->setSubscriptions($this->subscriptions);
        $this->reportSubscription->setUsers($this->users);
        $this->reportSubscription->createSerializer();
    }


    /**
     * 
     */
    public function getReportSubscribtions() {
        $this->reportSubscription->generateReportAllSubscription();
    }
}
