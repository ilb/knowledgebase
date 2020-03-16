<?php

namespace observer;

class OfferObserver implements Observer {
    
    public function execute($user, $textNotificate, $event) {
        $this->send();
    }
    
    private function send($user, $textNotificate) {
        return "одобрение статьи. Уведомлен пользователь: " . $user->getLogin();
    }
}