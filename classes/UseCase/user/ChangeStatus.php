<?php
/**
 * Меняет статус пользователя
 */

namespace usecase\user;


use repository\Repository;

class ChangeStatus {

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
        $repo = new Repository();
        return $repo->changeStatus($this->id_user, $this->status);
    }
}