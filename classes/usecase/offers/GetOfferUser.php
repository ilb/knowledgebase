<?php


namespace usecase\offers;


use response\Response;
use usecase\helper\UseCase;

class GetOfferUser extends UseCase {

    /**
     * @var string
     */
    private $login;

    /**
     * GetOfferUser constructor.
     * @param $login
     */
    public function __construct($login) {
        $this->login = $login;
    }

    public function execute() {
        return new Response($this->repository->getReportUser($this->login));
    }
}