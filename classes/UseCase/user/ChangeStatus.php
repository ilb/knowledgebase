<?php
/**
 * Меняет статус пользователя
 */

namespace usecase\user;


use repository\Repository;
use usecase\helper\UseCase;

class ChangeStatus extends UseCase {

    /**
     * @var int
     */
    private $id_user;

    /**
     * @var string
     */
    private $status;

    public function __construct($id_user, $status) {
        $this->id_user = $id_user;
        $this->status = $status;
    }

    public function execute() {
        return $this->repository->changeStatus($this->id_user, $this->status);
    }
}