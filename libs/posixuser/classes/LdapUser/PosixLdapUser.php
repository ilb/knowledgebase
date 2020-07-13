<?php

namespace LdapUser; 

/**
 * Проверка прав внутреннего пользователя ldap, с помощью posix групп
 */
class PosixLdapUser implements LdapUser {

    /**
     *
     * @var String
     */
    private $remoteUser;

    /**
     *
     * @var PosixImpl
     */
    private $posix;
    /**
     * 
     * @param String $remoteUser
     * @return void
     */
    public function __construct($remoteUser) {
        $this->remoteUser = $remoteUser;
    }
    
    /**
     * 
     * @param Posix $posix
     */
    public function setPosix($posix) {
        $this->posix = $posix;
    }

    /**
     * 
     * @param type $groupName
     * @return boolean
     */
    public function hasPermission($groupName) {
        $groupInfo = $this->posix->getgrnam($groupName);
        if (!$groupInfo) {
            return false;
        }
        if (!in_array($this->remoteUser, $groupInfo['members'])) {
            return false;
        }
        return true;
    }

    /**
     * 
     * @param String $groupName
     * @return void
     * @throws Exception
     */
    public function enforce($groupName) {
        if (!$this->hasPermission($groupName)) {
            throw new \Exception("Нет доступа пользователю: " . $this->remoteUser, 453);
        }
    }

}
