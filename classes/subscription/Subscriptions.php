<?php

namespace subscription;

class Subscriptions {

    /**
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
            
            if (!$subscription->checkRead($userName) && $filtr == 1) {
                $find[] = $subscription;
            }
            
            if ($subscription->checkRead($userName) && $filtr == 2) {
                $find[] = $subscription;
            }
            
            if ($subscription->checkUser($userName) && $filtr == 0) {
                $find[] = $subscription;
            }
        }
        return  $subscription;
    }

}
