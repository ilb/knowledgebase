<?php

namespace LdapUser;

interface LdapUser {
    /**
     * 
     * @param String $groupName
     * @return boolean
     */
    public function hasPermission($groupName);
 
    /**
     * 
     * @param String $groupName
     * @return void
     * @throws Exception
     */
    public function enforce($groupName);
}
