<?php

namespace observer;

class OfferObserver implements Observer {
    
    /**
     * 
     * @param \user\User $user
     * @param string $textNotificate
     * @param string $event
     */
    public function execute($user, $textNotificate, $event) {
        $this->send();
    }
    
    /**
     * 
     * @param \user\User $user
     * @param string $textNotificate
     * @return string
     */
    private function send($user, $textNotificate) {
        return "одобрение статьи. Уведомлен пользователь: " . $user->getLogin();
    }
}