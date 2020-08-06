<?php

/**
 * Получение списка всех пользователей
 */

namespace usecase\user;


use usecase\helper\UseCase;

class GetUsersList extends UseCase {

    /**
     * @return array[]|\response\Response
     */
    public function execute() {
        $users = $this->repository->getUsers();
        return array("users" => ["user" => $users]);
    }
}