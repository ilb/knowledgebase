<?php
class Notification {
    private $subscribtions;
    
    public function setSubscribtions($subscribtions) {
        $this->subscribtions = $subscribtions;
    }

    public function notify($idDoc, $textNotificate) {
        $users = $this->subscribtions->getUsers($idDoc);
        foreach ($users as $user) {
            $this->sendNotification($user, $textNotificate);
        }
    }
    
    public function sendNotification($user, $textNotification) {
        
    }
}
