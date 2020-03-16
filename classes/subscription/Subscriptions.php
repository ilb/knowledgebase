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
     * @param type $changeElement
     * @return array \subscription\Subscription
     */
    public function foundSubscription($changeElement) {
        $foundSubscription = array();
        foreach ($this->subscribtions as $subscription) {
            if ($subscription->getElement() == $changeElement) {
                $foundSubscription[] = $subscription;
            }
        }
        return $foundSubscription;
    }

    /**
     * 
     * @param \user\User $user
     * @return array \subscription\Subscription()
     */
    public function getMaterialDontRead($user) {
        $find = array();
        foreach ($this->subscribtions as $subscription) {
            if (!$subscription->checkRead($user->getLogin())) {
                $find = $subscription;
            }
        }
        return $find;
    }

}
