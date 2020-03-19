<?php

namespace controller;

class MentorController extends UserController {
    
    /**
     *
     * @var \report\ReportSubscriptions
     */
    protected $reportSubscription;
    
    /**
     * @var array<\user\User>
     */
    protected $users = [];
    
    /**
     * Добавляет подписку
     * @param string $nameElement
     * @param \user\User $user
     */
    public function addSubscribtion($nameElement, $user) {
        $this->subscriptions->subscribe($nameElement, $user);
    }
    
    /**
     * Создает все необходимое для формирования отчета
     */
    public function createReportSubscriptions() {
        $this->reportSubscription = new \report\ReportSubscriptions();
        $this->reportSubscription->setSubscriptions($this->subscriptions);
        $this->reportSubscription->setUsers($this->users);
        $this->reportSubscription->createSerializer();
    }


    /**
     * Отчет по пользовательским подпискам
     */
    public function getReportSubscribtions() {
        $this->reportSubscription->generateReportAllSubscription();
    }
    
    /**
     * Добавление подключившегося пользователя
     * @param \user\User $user
     */
    public function connctionUser($user) {
        $this->users[] = $user;
    }
}
