<?php

/*
 * Добавляет новую подписку
 */

namespace usecase\subscriptions;

use repository\Repository;
use usecase\helper\UseCase;

class SubscriptionCreate extends UseCase  {
    
    /**
     * @var string
     */
    private $userLogin;
    
    /**
     * @var string
     */
    private $material;
    
    /**
     * @param string $userLogin
     * @param string $material
     */
    public function __construct($userLogin, $material) {
        $this->userLogin = $userLogin;
        $this->material = $material;
    }
    
    public function execute() {
        return $this->repository->addSubscription($this->userLogin, $this->material);
    }
}
