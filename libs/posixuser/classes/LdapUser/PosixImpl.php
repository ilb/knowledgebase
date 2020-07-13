<?php

namespace LdapUser;

class PosixImpl implements Posix {
    
    /**
     * @param string $groupName
     * @return array
     */
    public function getgrnam($groupName) {
        return posix_getgrnam($groupName);
        // impl posix_getgrnam
    }
    
}