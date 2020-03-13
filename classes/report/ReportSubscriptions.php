<?php

class ReportSubscriptions {
    /**
     *
     * @var array \users\User()
     */
    private $users = array();
    
    /**
     *
     * @var \subscriptions\Subscriptions()
     */
    private $subscriptions;
    
    /**
     * создает отчет по не прочитанным подпискам
     */
    public function generateReport() {
        $material = $this->subscriptions->getMaterialDontRead();
    }
}
