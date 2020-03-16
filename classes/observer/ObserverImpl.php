<?php

namespace observer;

class ObserverImpl  implements Observer {
    /**
     *  Класс подписки
     * @var \subscription\Subscriptions
     */
    private $subscriptions;
    
    /**
     * Какой элемент был изменен (и изменения) 
     * @param string $element
     * @param string $diff
     */
    public function execute($element, $diff, $event) {
        $subscriptionNotify = $this->subscriptions->getSubscriptionByElementName($element);
        foreach ($subscriptionNotify as $subscription) {
            $subscription->setIsRead(false);
            $this->send($subscription->getUser(), $diff);
        }
    }
    
    /**
     * Отправка уведомления пользователю
     * @param \user\User $user
     * @param string $text
     */
    private function send($user, $text) {
        /**
         * Для рассылки пока будет так
         */
        echo "\r\nУведомлен пользователь: " . $user->getLogin() . "\r\n";
    }
    
    /**
     * @param \subscription\Subscriptions $subscriptions
     */
    public function setSubscriptions($subscriptions) {
        $this->subscriptions = $subscriptions;
    }
}

