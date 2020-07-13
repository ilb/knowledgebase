<?php

namespace User;

interface UserInterface {
    /**
     * 
     * @param Integer $level
     * @return boolean
     */
    public function hasPermission($level);
    
    /**
     * 
     * @param Integer $level
     * @return void
     * @throws Exception
     */
    public function enforce($level);
    
    /**
     * @return void
     */
    public function checkAuth();
}
