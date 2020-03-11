<?php

class Subscribtions {
    /**
     * @var Array Object class Subscription
     */
    private $subscriptions = [];
    
    /**
     * Вызывается когда пользователь подписывается на документ
     */
    public function subscribe($user, $document) {
        $this -> subscriptions[] = new Subscribtion($user, $document);
    }
    
    /**
     * 
     * @param string $idDoc
     * @return Array object class User
     */
    public function getUsers($idDoc) {
        $users = [];
        foreach ($this->subscriptions as $subscription) {
            if ($idDoc == $subscription->getDocumentId()) {
                $users[] = $subscription->getUser();
            }
        }
        return $users;
    }
    
}
