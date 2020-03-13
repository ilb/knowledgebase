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
        foreach ($this->subscribtions as $element) {
            if (!$element->getElement() instanceof $changeElement) {
                continue;
            }
            if ($element->getElement()->getUnicalName() == $changeElement->getUnicalName()) {
                $foundSubscription[] = $element;
            }
        }
        return $foundSubscription;
    }

    /**
     * 
     * @param \user\User() $user
     * @return array \subscription\Subscription()
     */
    public function getMaterialDontRead($user) {
        $find = array();
        foreach ($this->subscribtions as $subscription) {
            if ($subscription->getUser()->getLogin() != $user->getLogin()) {
                continue;
            }
            foreach ($subscription->getReadInfo() as $read) {
                if (!$read) {
                    $find[] = $subscription;
                    break;
                }
            }
        }
        return $find;
    }

}
