<?php

namespace observer;

class ElementObserver  implements \observer\Observer {
    /**
     *  Класс подписки
     * @var array \subscription\Subscriptions()
     */
    private $subscriptions;
    
    /**
     * Какой элемент был изменен (и текст изменения?) 
     * @param \elements\Element $element
     * @param string $textNotify
     */
    public function execute($element, $textNotify) {
        $subscriptionNotify = $this->subscriptions->foundSubscription($element);
        foreach ($subscriptionNotify as $subscription) {
            $this->send($subscription->getUser(), $textNotify);
        }
    }
    
    /**
     * Отправка уведомления пользователю
     * @param \user\User $user
     * @param string $text
     */
    public function send($user, $text) {
        /**
         * Для рассылки пока будет так
         */
        return "Уведомлен пользователь: " . $user->getLogin();
    }
}

