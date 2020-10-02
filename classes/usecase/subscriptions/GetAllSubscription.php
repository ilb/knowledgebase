<?php


namespace usecase\subscriptions;


use subscription\Subscription;
use subscription\Subscriptions;
use usecase\helper\UseCase;
use user\User;

class GetAllSubscription extends UseCase {

    public function execute() {
        $subs = $this->repository->getSubscribtions();
        $subscriptions = new Subscriptions();
        foreach ($subs as $value) {
            $user = new User($value["login"]);
            $name = $value['name_material'];
            $parent = "";
            if (preg_match_all("/[#]/", $name)) {
                $parent = explode("#", $name)[0];
                $name = "#" . explode("#", $name)[1];
            }
            $sub = new Subscription($user, $name);
            $sub->setParent($parent);
            if ($value['is_read']) {
                $sub->setIsRead(1);
            }
            $subscriptions->AddSubscription($sub);
        }
        return $subs;
    }
}