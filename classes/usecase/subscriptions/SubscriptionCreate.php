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
    private $name;
    
    /**
     * @var string
     */
    private $material;

    /**
     * @var bool
     */
    private $isGroup;

    /**
     * @param $name
     * @param string $material
     * @param $isGroup
     */
    public function __construct($name, $material, $isGroup) {
        $this->name = $name;
        $this->material = $material;
        $this->isGroup = $isGroup;
    }
    
    public function execute() {
        $users = [];
        if ($this->isGroup) {
            $group = posix_getgrnam($this->name);
            $users = $group ? $group["members"] : [];
        } else {
            $users[] = $this->name;
        }
        foreach ($users as $user) {
            $this->repository->addSubscription($user, $this->material);
        }
    }
}
