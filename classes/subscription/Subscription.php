<?php

namespace subscription;

class Subscription {
    
    /**
     * Хранит в себе либо 
     * nameDoc 
     * или
     * #tag
     * @var string
     */
    private $element;
    
    /**
     * @var \user\User
     */
    private $user;
    
    /**
     * Значение логический прочитана или нет
     * @var boolean
     */
    private $isRead = false;
    
    /**
     * @param \user\User $user
     * @param string $element
     */
    public function __construct($user, $element) {
        $this->user = $user;
        $this->element = $element;
    } 
    
    /**
     * @return string
     */
    public function getElement() {
        return $this->element;
    }
    
    /**
     * @return \user\User
     */
    public function getUser() {
        return $this->user;
    }
    
    /**
     * @return boolean
     */
    public function getIsRead() {
        return $this->isRead;
    }
    
    /**
     * Задает значение прочитана или нет 
     * @param boolean $value
     */
    public function setIsRead($value) {
        $this->isRead = $value;
    }

    /**
     * Принимает имя пользователя и проверяет прочитана ли подписка
     * @param string $userName
     * @return boolean
     */
    public function checkRead($userName) {
        if ($this->checkUser($userName)) {
            return $this->isRead;
        }
        return false;
    }
    
    /**
     * Проверяет пользователя есть ли у него данная подписка
     * @param string $userName
     * @return boolean
     */
    public function checkUser($userName) {
        return $userName == $this->user->getLogin();
    }
}

