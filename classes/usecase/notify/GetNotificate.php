<?php


namespace usecase\notify;


use response\Response;
use usecase\helper\UseCase;

class GetNotificate extends UseCase {

    /**
     * @var string
     */
    private $user;

    public function __construct($user) {
        $this->user = $user;
    }

    public function execute() {
        $res = $this->repository->getNotificateByUser($this->user);
        return array("result" => $res);
    }
}