<?php

/*
 * Добавляет новую подписку
 */

namespace usecase\subscriptions;

class SubscriptionCreate {
    
    /**
     * @var \user\User
     */
    private $user;
    
    /**
     * @var string
     */
    private $material;
    
    /**
     * @param \user\User $user
     * @param string $material
     */
    public function __construct($user, $material) {
        $this->user = $user;
        $this->material = $material;
    }
    
    public function execute() {
        
    }
}
