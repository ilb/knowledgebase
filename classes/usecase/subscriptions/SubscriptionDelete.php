<?php


namespace usecase\subscriptions;


use usecase\helper\UseCase;

class SubscriptionDelete extends UseCase {

    /**
     * @var string
     */
    private $document;

    /**
     * @var string
     */
    private $login;

    /**
     * SubscriptionDelete constructor.
     * @param string $document
     * @param string $login
     */
    public function __construct($document, $login) {
        $this->document = $document;
        $this->login = $login;
    }


    public function execute() {
        $this->repository->removeSubscription($this->document, $this->login);
    }
}