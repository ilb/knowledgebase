<?php

namespace observer;

class ObserverImpl  implements Observer {
    /**
     *  Класс подписки
     * @var array \subscription\Subscriptions()
     */
    private $subscriptions;
    
    /**
     * Какой элемент был изменен (и изменения) 
     * @param string $element
     * @param string $textNotify
     */
    public function execute($element, $diff, $event) {
        $subscriptionNotify = $this->subscriptions->getSubscriptionByElementName($element);
        foreach ($subscriptionNotify as $subscription) {
            $subscription->setIsRead(false);
            $this->send($subscription->getUser(), $textNotify);
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
        return "Уведомлен пользователь: " . $user->getLogin();
    }
    
    /**
     * 
     * @param \subscription\Subscriptions $subscriptions
     */
    public function setSubscriptions($subscriptions) {
        $this->subscriptions = $subscriptions;
    }
}

