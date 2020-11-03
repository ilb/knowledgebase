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
            if (strpos($arr["elem"], "trunk/docs")) {
                $names[] = str_replace("trunk/docs", "knowledgebasedoc",  $arr["elem"])[0];
            }
            $names[] = $arr["elem"];
        }
        mail("gudov@bystrobank.ru", "База знаний", print_r($names, true), "Content-type: text/plain; charset=utf-8");
        $subs = $this->repository->getSubscriptionByNamesMaterial($names);
        $id = [];
        foreach ($subs as $arr) {
            $id[] = $arr["id_subscription"];
            for ($i = 0; $i < count($this->elements); $i++) {
                $this->elements[$i]['full_name'] = $arr['name_material'];
                $name = explode("#", $arr['name_material'])[0];
                if ($this->elements[$i]['elem'] == $name) {
                    $this->elements[$i]["id_subs"] = $arr["id_subscription"];
                    $user = [];
                    $user["id_user"] =  $arr["user_id"];
                    $user["login"] = $arr["login"];
                    $this->elements[$i]["user"][] = $user;
                }
            }
        }
        if (count($id) == 0) {
//            throw new \Exception("Подписок на данные файлы не найдены", 404);
            return false;
        }
        $this->repository->setSubscriptionNotViewed($id);
        $this->repository->addNotificate($this->elements);
        
        foreach ($this->elements as $element) {
            if (!isset($element["user"])){
                continue;
            }
            foreach ($element["user"] as $user) {
                $names = explode("#", $element['full_name']);
                $url = "https://devel.net.ilb.ru/knowledgebase"
                        ."/web/SubscriptionsList.php?link_to-0=" .$names[0];
                if (isset($names[1])) {
                    $url .= "&link_tag-0=" . $names[1];
                }
                $message = "Изменение в документе " . $names[0] . "\n";
                $message .= "Для ознакомления перейдите по ссылке $url\n\n";
                $message .= "Изменения: \n" . $element["data"];
                mail($user["login"] . "@bystrobank.ru", "База знаний", $message, "Content-type: text/plain; charset=utf-8");
            }
        }
        return true;
    }
}