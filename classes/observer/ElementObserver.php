<?php

namespace observer;

class ElementObserver  implements \observer\Observer {
    private $subscriptions;
    
    
    public function execute($element, $textNotify) {
        $res = [];
        $subscriptionNotify = $this->subscriptions->foundSubscription($element);
        foreach ($subscriptionNotify as $subscription) {
            $res[] = $this->send($subscription->getUser(), $textNotify);
        }
        return $res;
    }
    
    
    public function send($user, $text) {
        return "Уведомлен пользователь: " . $user->getLogin();
    }
}

