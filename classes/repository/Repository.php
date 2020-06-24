<?php

/**
 * Для работы с базой данной
 */

namespace repository;

class Repository
{

    /**
     * @var string
     */
    private $host = 'localhost';

    /**
     * @var string
     */
    private $dbname = 'knowledgebase';

    /**
     * @var string
     */
    private $dbuser = 'root';

    /**
     * @var string
     */
    private $password = '';

    /**
     * @var \PDO
     */
    private $dbconnect;

    /**
     * Создает подключение к базе при создании класса
     */
    public function __construct() {
        $this->dbconnect = new \PDO("mysql:host=$this->host;dbname=$this->dbname", $this->dbuser, $this->password);
    }

    /**
     * Возвращает все ключевые слова из базы данных
     * @param string $documentName
     */
    public function getKeywords($documentName) {
        $res = $this->dbconnect->prepare(
            "SELECT
                `keyword`.`name_keyword`
            FROM
                `keyword`
            INNER JOIN(
                    `material_from_keyword`
                INNER JOIN `material` ON `material`.`id_material` = `material_from_keyword`.`material_id`
                )
            ON
                `keyword`.`id_keyword` = `material_from_keyword`.`keyword_id`
            WHERE
                `material`.`name_material` = ?"
        );
        $res->execute([$documentName]);
        return $res->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Получить все подписки
     * @return array
     */
    public function getSubscribtions() {
        $sql = "SELECT
                    `material`.`name_material` AS `name`,
                    `material`.`source`,
                    `material`.`type`,
                    `user`.`login`,
                    `subscriptions`.`is_read`
                FROM
                    `user`
                    INNER JOIN(
                        `subscriptions` INNER JOIN `material` ON `subscriptions`.`material_id` = `material`.`id_material`
                    )
                ON
                    `user`.`id_user` = `subscriptions`.`user_id`
                ORDER BY
                    `user`.`login`";
        $res = $this->dbconnect->query($sql);
        //        $subscriptions = new \subscription\Subscriptions();
        //        $user = new \user\User($login);
        //        foreach ($answ as $value) {
        //            $name = $value['name'];
        //            if (preg_match_all("/[#]/", $name)) {
        //                $name = "#" . explode("#", $name)[1];
        //            }
        //            $subscriptions->subscribe($name, $user);
        //            if ($value['is_read']) {
        //                $subscriptions->getSubscriptionsByUserElement($user, $name)->setIsRead(1);
        //            }
        //        }
        return $res->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Получить подписку по логину пользователя
     * @param string $login
     * @return array<dict<string,any>>
     */
    public function getSubscribtionsByUser($login) {
        $sql = "SELECT
                `material`.`name_material` AS `name`,
                `material`.`source`,
                `material`.`type`,
                `user`.`login`,
                `subscriptions`.`is_read`
            FROM
                `user`
                INNER JOIN(
                    `subscriptions` INNER JOIN `material` ON `subscriptions`.`material_id` = `material`.`id_material`
                )
            ON
                `user`.`id_user` = `subscriptions`.`user_id`
            Where `user`.`login` = ?
            ORDER BY
                `user`.`login`";
        $res = $this->dbconnect->prepare($sql);
        $res->execute(array($login));
        return $res->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * SELECT
     * `document`.`name_document`,
     * `document`.`source_document`
     * FROM
     * `document`
     * INNER JOIN(
     * `document_to_keyword`
     * INNER JOIN `keyword` ON `document_to_keyword`.`keyword_id` = `keyword`.`id_keyword`
     * )
     * ON
     * `document_to_keyword`.`document_id` = `document`.`id_document`
     * WHERE
     * `keyword`.`name_keyword` = ?
     */
    public function getDocumentByKewords($keyWord) {
        /**
         * $this->dbconnect
         */
        return [
            [
                "link" => "https://ilb.github.io/devmethodology/knowlegebase.xhtml#variant__ispol_zovanij"
            ]
        ];
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

    /**
     * Возвращает все правки
     * @return array
     */
    public function getOffersList() {
        $sql = "
        SELECT
            `offers`.`id_offer`,
            `offers`.`diff`,
            `material`.`name_material`,
            `material`.`source`,
            `user`.`login`
        FROM
          `user`
        INNER JOIN(
                `offers`
            INNER JOIN `material` ON `offers`.`material_id` = `material`.`id_material`
            )
        ON
            `user`.`id_user` = `offers`.`user_id`";
        $res = $this->dbconnect->query($sql);
        return $res->fetchAll(\PDO::FETCH_ASSOC);
    }
}
