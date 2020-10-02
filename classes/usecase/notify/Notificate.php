<?php


namespace usecase\notify;


use usecase\helper\UseCase;

class Notificate extends UseCase {

    /**
     * @var array
     */
    private $elements;

    public function __construct($elements) {
        $this->elements = $elements;
    }

    public function execute() {
        $names= [];
        foreach ($this->elements as $arr) {
            $names[] = $arr["elem"];
        }
        $subs = $this->repository->getSubscriptionByNamesMaterial($names);

        $id = [];
        foreach ($subs as $arr) {
            $id[] = $arr["id_subscription"];
        }
        $this->repository->setSubscriptionNotViewed($id);
        for ($i = 0; $i < count($this->elements); $i++) {
            $this->elements[$i]["id_subs"] = $id[$i];
            $this->elements[$i]["id_user"] = $names[$i];
        }
        $this->repository->addNotificate($this->elements);
    }
}