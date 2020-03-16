<?php

namespace subscription;

class Subscriptions {

    /**
     * @var array \subscription\Subscription
     */
    private $subscribtions = array();

    public function subscribe($element, $user) {
        $this->subscribtions[] = new \subscription\Subscription($user, $element);
    }

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
     * Получает все подписки пользователя
     * @param \user\User $user
     * @param integer $filtr 
     *  Содержит значения:
     *  0 - без сортировки 
     *  1 - только не прочитанные
     *  2 - толкьо прочитанные 
     * @return array(\subscription\Subscription)
     */
    public function getSubscriptionByUser($user, $filtr = 0) {
        $find = array();
        foreach ($this->subscribtions as $subscription) {
            $userName = $user->getLogin();
            if (!$subscription->checkUser($userName)) {
                continue;
            }
            if ($this->hasAddFind($subscription->checkRead($userName), $filtr)) {
                $find[] = $subscription;
            }
        }
        return  $find;
    }
    
    /**
     * @param boolean $readed
     * @param integer $filter
     * @return boolean
     */
    public function hasAddFind($readed, $filter) {
        if ($filter == 0) {
            return true;
        } 
        if ($filter == 1 && !$readed) {
            return true;
        }
        if ($filter == 2 && $readed) {
            return true;
        }
        return false;
    }

}
