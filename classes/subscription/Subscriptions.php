<?php

namespace subscription;

class Subscriptions {

    /**
     *
     * @var array \subscription\Subscription
     */
    private $subscribtions = array();

    /**
     * Находит все подписки содержащие в себе измененный документ
     * @param string $changeElement
     * @return array \subscription\Subscription
     */
    public function getSubscriptionByElementName($changeElement) {
        $foundSubscription = array();
        foreach ($this->subscribtions as $subscription) {
            if ($subscription->getElement() == $changeElement) {
                $foundSubscription[] = $subscription;
            }
        }
        return $foundSubscription;
    }

    /**
     * Получает все не прочитаные подписки пользователя
     * 
     * А НУЖЕН ЛИ ЭТОТ МЕТОД? 
     * МОЖНО ПРОСТО ПОЛУЧАТЬ ИЗ ВСЕХ ПОДПИСОК И ПРОСМАТРИВАТЬ
     * ХМММ
     * 
     * @param \user\User $user
     * @return array \subscription\Subscription()
     */
    public function getSubscriptionDontRead($user) {
        $find = array();
        foreach ($this->subscribtions as $subscription) {
            if (!$subscription->checkRead($user->getLogin())) {
                $find = $subscription;
            }
        }
        return $find;
    }
    
    /**
     * Получает все подписки пользователя
     * @param \user\User $user
     * @return array(\subscription\Subscription)
     */
    public function getSubscriptionByUser($user) {
        $find = array();
        foreach ($this->subscribtions as $subscription) {
            if ($subscription->getUser()->getLogin() == $user->getLogin()) {
                $find[] = $subscription;
            }
        }
        return  $subscription;
    }

}
