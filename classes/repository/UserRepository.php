<?php


namespace repository;


class UserRepository {

    /**
     * @var \PDO
     */
    protected $dbconnect;

    /**
     * Создает подключение к базе при создании класса
     * @param $connect \PDO
     */
    public function __construct($connect) {
        $this->dbconnect = $connect;
    }

    /**
     * Список всех пользователей в базе
     * @return array
     */
    public function getUsers() {
        $sql = "
            SELECT * FROM `user`
        ";
        $res = $this->dbconnect->query($sql);
        return $res->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Получение пользователя по логину
     * @param $name
     * @return array
     */
    public function getUserByName($name) {
        $sql = "
            SELECT * FROM `user` WHERE `user`.`login` = ?
        ";
        $res = $this->dbconnect->prepare($sql);
        $res->execute(array($name));
        return $res->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Изменяет статус пользователя
     * @param $id_user
     * @param $status
     * @return bool
     */
    public function changeStatus($id_user, $status) {
        $sql = "
            Update `user` SET `status` = ? WHERE `id_user` = ?
        ";
        $res = $this->dbconnect->prepare($sql);
        return $res->execute(array($status, $id_user));
    }


}