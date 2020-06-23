<?php

/**
 * Получение списка всех пользователей
 */

namespace usecase\user;


class UsersList {

    public static function execute() {
        $res = new \repository\Repository();
        return $res->getUsers();
    }
}