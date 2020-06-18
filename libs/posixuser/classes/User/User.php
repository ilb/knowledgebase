<?php

namespace User;

/**
 * Проверка прав внешнего пользователя
 */
class User implements UserInterface {
    
    /**
     *
     * @var Integer
     */
    private $securityLevel;
    
    /**
     *
     * @var String
     */
    private $remoteUser;

        /**
     * 
     * @param Integer $securityLevel
     * @param String $remoteUser
     */
    public function __construct($securityLevel, $remoteUser) {
        $this->securityLevel = $securityLevel;
        $this->remoteUser = $remoteUser;
    }
    /**
     * 
     * @return Integer
     */
    public function getSecurityLevel() {
        return $this->securityLevel;
    }

    /**
     * 
     * @return String
     */
    public function getRemoteUser() {
        return $this->remoteUser;
    }


    /**
     * Проверяет уровень доступа пользователя
     * @param Integer $level
     * @return boolean
     */
    public function hasPermission($level) {
        if ($level <= $this->securityLevel) {
            return true;
        }
        return false;
    }
    
    /**
     * Выдает исключение если уровень пользователя ниже требуемого
     * @param Integer $level
     * @return void
     * @throws Exception
     */
    public function enforce($level) {
        if (!$this->hasPermission($level)) {
            throw new \Exception("Нет доступа", 453);
        }
    }
    
    /**
     * Проверяет авторизован ли пользователь
     * @return void
     */
    public function checkAuth() {
        if (!$this->hasPermission(40)) {
            header("Location: /auth.php");
            exit();
        }
    }
}