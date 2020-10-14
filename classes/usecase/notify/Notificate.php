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
        if (count($id) == 0) {
//            throw new \Exception("Подписок на данные файлы не найдены", 404);
            return false;
        }
        $this->repository->setSubscriptionNotViewed($id);
        for ($i = 0; $i < count($this->elements); $i++) {
            if (!isset($id[$i])) {
                break;
            }
            $this->elements[$i]["id_subs"] = $id[$i];
            $this->elements[$i]["id_user"] = $subs[$i]["user_id"];
            $this->elements[$i]["login"] = $subs[$i]["login"];
        }
        $this->repository->addNotificate($this->elements);
        foreach ($this->elements as $element) {
            if (isset($element["login"])){
                mail($element["login"]."@bystrobank.ru", "База знаний", $element["data"]);
            }
        }
        return true;
    }
}