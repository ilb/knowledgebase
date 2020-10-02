<?php

namespace subscription;

class Subscriptions {

    /**
     * @var array<\subscription\Subscription>
     */
    private $subscribtions = array();

    /**
     * 
     * @param string $element
     * @param \user\User $user
     */
    public function subscribe($element, $user) {
        $this->subscribtions[] = new Subscription($user, $element);
    }

    public function AddSubscription($sub) {
        $this->subscribtions[] = $sub;
    }

    /**
     * Находит все подписки содержащие в себе измененный документ
     * @param string $nameElement
     * @return array<\subscription\Subscription>
     */
    public function getSubscriptionByElementName($nameElement) {
        $foundSubscription = array();
        foreach ($this->subscribtions as $subscription) {
            if ($subscription->getElement() == $nameElement) {
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
     * @return array<\subscription\Subscription>
     */
    public function getSubscriptionByUser($user, $filtr = 0) {
        $find = array();
        foreach ($this->subscribtions as $subscription) {
            $userName = $user->getLogin();
            if (!$subscription->checkUser($userName)) {
                continue;
            }
            if ($this->hasAddFind($subscription->checkRead(), $filtr)) {
                $find[] = $subscription;
            }
        }
        return  $find;
    }
    
    /**
     * @param integer $filtr
     * @return array<\subscription\Subscription>
     */
    public function getSubscriprions($filtr = 0) {
        $find = [];
        foreach ($this->subscribtions as $subscription) {
            if ($this->hasAddFind($subscription->checkRead(), $filtr)) {
                $find[] = $subscription;
            }
        }
        return $find;
    }

    /**
     * @param boolean $readed
     * @param integer $filter
     * @return boolean
     */
    public function hasAddFind($readed, $filter) {
        if ($filter == EnumFiltr::noFiltr) {
            return true;
        } 
        if ($filter == EnumFiltr::dontReadFiltr && !$readed) {
            return true;
        }
        if ($filter == EnumFiltr::isReadFiltr && $readed) {
            return true;
        }
        return false;
    }
    
    /**
     * 
     * @param string $element
     * @param \user\User $user
     * @return Subscription
     */
    public function getSubscriptionsByUserElement( $user, $element) {
        foreach ($this->subscribtions as $subscription) {
            $nameElement = $subscription->getElement();
            $userName = $subscription->getUser()->getLogin();
            if ($nameElement == $element && $userName == $user->getLogin()) {
                return $subscription;
            }
        }
    }

}
