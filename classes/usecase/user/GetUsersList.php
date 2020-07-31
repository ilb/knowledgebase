<?php

/**
 * Получение списка всех пользователей
 */

namespace usecase\user;


use usecase\helper\UseCase;

class GetUsersList extends UseCase {

    public function execute() {
        return $this->repository->getUsers();
    }
}