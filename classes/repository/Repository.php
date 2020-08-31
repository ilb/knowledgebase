<?php

/**
 * Для работы с базой данной
 */

namespace repository;

class Repository {

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

    public function deleteDocument($nameDcoument) {

    }

    /**
     * Получить все подписки
     * @return array
     */
    public function getSubscribtions() {
        $sql = "SELECT
                    `material`.`name_material` AS `name`,
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
     * @return array
     */
    public function getSubscribtionsByUser($login) {
        $sql = "SELECT
                `material`.`name_material` AS `name`,
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
            Where `user`.`login` = ?";
        $res = $this->dbconnect->prepare($sql);
        $res->execute([$login]);
        return $res->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @param $login string
     * @param $material_name string
     */
    public function setSubscriptionIsView($login, $material_name) {
        $sql = "UPDATE
                `user`
                INNER JOIN(
                    `subscriptions` INNER JOIN `material` ON `subscriptions`.`material_id` = `material`.`id_material`
                )
            ON
                `user`.`id_user` = `subscriptions`.`user_id`
            SET `subscriptions`.`is_read` = 1
            Where `user`.`login` = ? and `material`.`name_material` = ?";
        $res = $this->dbconnect->prepare($sql);
        return $res->execute([$login, $material_name]);
    }

    /**
     * Записывает подписку в БД
     * @param $login
     * @param $material_name
     * @return bool
     */
    public function addSubscription($login, $material_name) {
        $id_user = $this->getUserId($login);
        $id_material = $this->getMaterialId($material_name);
        $sql = "INSERT INTO `subscriptions`( `user_id`, `material_id`, `is_read`) VALUES (?, ?, 0)";
        $res = $this->dbconnect->prepare($sql);
        return $res->execute([$id_user, $id_material]);
    }

    /**
     * Возвращает id пользователя из БД
     * @param $login
     * @return mixed
     */
    public function getUserId($login) {
        $sql = "Select `id_user` FROM user WHERE login = ?";
        $res = $this->dbconnect->prepare($sql);
        $res->execute([ $login ]);
        return $res->fetchAll(\PDO::FETCH_ASSOC)[0]['id_user'];
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
        $keywords = [];
        foreach ($res->fetchAll(\PDO::FETCH_ASSOC) as $keyW) {
            $keywords[] = $keyW["name_keyword"];
        }
        return $keywords;
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
     * Возвращает все правки
     * @return array
     */
    public function getOffersList() {
        $sql = "
        SELECT
            `offers`.`id_offer`,
            `offers`.`diff`,
            `material`.`name_material`,
            `user`.`login`
        FROM
          `user`
        INNER JOIN(
                `offers`
            INNER JOIN `material` ON `offers`.`material_id` = `material`.`id_material`
            )
        ON
            `user`.`id_user` = `offers`.`user_id`
        WHERE `offers`.`accepted` = 0";
        $res = $this->dbconnect->query($sql);
        return $res->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Возвращает id материала из БД
     * @param $material_name
     * @return mixed
     */
    public function getMaterialId($material_name) {
        $sql = "SELECT `id_material` FROM `material` WHERE `name_material` = ?";
        $res = $this->dbconnect->prepare($sql);
        $res->execute([ $material_name ]);
        return $res->fetchAll(\PDO::FETCH_ASSOC)[0]['id_material'];
    }

    public function getMaterials() {
        $sql = "SELECT * FROM `material`";
        $res = $this->dbconnect->query($sql);
        return $res->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Записывает материал предоженный на изменения в БД
     * @param $login
     * @param $material_name
     * @param $diff
     * @return bool
     */
    public function addOffers($login, $material_name, $diff) {
        $id_user = $this->getUserId($login);
        $id_material = $this->getMaterialId($material_name);
        $sql = "INSERT INTO `offers`(`material_id`, `user_id`, `diff`) VALUES (?, ?, ?)";
        $res = $this->dbconnect->prepare($sql);
        return $res->execute([ $id_material, $id_user, $diff ]);
    }

    /**
     * Добавляет ключевое слово к документу
     * @param $document_name
     * @param $new_keyword
     * @return bool
     */
    public function addkeyword($document_name, $new_keyword) {
        $id_document = $this->getMaterialId($document_name);
        $sql = "INSERT INTO `keyword`(`name_keyword`) VALUES (?)";
        $res = $this->dbconnect->prepare($sql);
        if ( !$res->execute([ $new_keyword ]) ) {
            return false;
        }
        $id_keyword = $this->dbconnect->lastInsertId();
        $sql = "INSERT INTO `material_from_keyword`(`material_id`, `keyword_id`) VALUES (?, ?)";
        $res = $this->dbconnect->prepare($sql);
        return $res->execute([ $id_document, $id_keyword ]);
    }

    /**
     * Добавление документа
     */
    public function addDocument($nameDocument, $source) {

    }

    /**
     *
     */
    public function editResource($documentName, $nameResource, $content) {

    }
}
