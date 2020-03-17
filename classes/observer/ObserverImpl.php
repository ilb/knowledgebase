<?php

namespace observer;

class ObserverImpl implements Observer {

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
        $subscriptionNotify = [];
        if (preg_match_all("/[#]/", $element)) {
            $namesElements = explode("#", $element);
            $subscriptionNotifyDoc = $this->subscriptions->getSubscriptionByElementName($namesElements[0]);
            $subscriptionNotifyResource = $this->subscriptions->getSubscriptionByElementName("#" . $namesElements[1]);
            $subscriptionNotify = $this->getUnicalSubscriprions($subscriptionNotifyResource, $subscriptionNotifyDoc);
        } else {
            $subscriptionNotify = $this->subscriptions->getSubscriptionByElementName($element);
        }
        foreach ($subscriptionNotify as $subscription) {
            $subscription->setIsRead(false);
            $this->send($subscription->getUser(), $diff);
        }
    }

    private function getUnicalSubscriprions($subscriptionNotifyResource, $subscriptionNotify) {
        $result = $subscriptionNotify;
        foreach ($subscriptionNotifyResource as $subsResource) {
            $flag = true;
            foreach ($subscriptionNotify as $subs) {
                if ($subs->getUser()->getLogin() == $subsResource->getUser()->getLogin()) {
                    $flag = false;
                }
            }
            if ($flag) {
                $result[] = $subsResource;
            }
        }
        return $result;
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
