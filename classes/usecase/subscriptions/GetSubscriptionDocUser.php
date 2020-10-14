<?php


namespace usecase\subscriptions;


use usecase\helper\UseCase;

class GetSubscriptionDocUser extends UseCase {

    /**
     * @var string
     */
    private $user;

    /**
     * @var string
     */
    private $name_material;

    /**
     * GetSubscriptionDocUser constructor.
     * @param string $user
     * @param string $name_material
     */
    public function __construct($user, $name_material) {
        $this->user = $user;
        $this->name_material = $name_material;
    }


    public function execute() {
        $result = $this->repository->getSubscribtionsByDocUser($this->name_material, $this->user);
        return array("response" => $result);
    }
}