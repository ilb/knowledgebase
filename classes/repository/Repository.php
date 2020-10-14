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

    /**
     * @param string
     */
    public function deleteDocument($nameDcoument) {
        $sql = "DELETE FROM `material` WHERE `name_material` = ?";
        $res = $this->dbconnect->prepare($sql);
        return $res->execute([ $nameDcoument ]);
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
        return $res->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @param $names array
     */
    public function getSubscriptionByNamesMaterial($names) {
        $sql = "SELECT
                m.id_material,
                m.name_material,
                s.user_id,
                u.login,
                s.is_read,
                s.id_subscription
            FROM material m INNER JOIN (subscriptions s  INNER JOIN user u on s.user_id = u.id_user )
            on s.material_id = m.id_material
            WHERE ";
        for ($i = 0; $i < count($names); $i++ ) {
            if ($i + 1 == count($names)) {
                $sql .= "m.name_material LIKE '$names[$i]%'";
                break;
            }
            $sql .= "m.name_material LIKE '$names[$i]%' or ";
        }
        $res = $this->dbconnect->query($sql);
        return $res->fetchAll(\PDO::FETCH_ASSOC);
    }


    /**
     * @param $names array
     */
    public function setSubscriptionNotViewed($names) {
        $sql = "UPDATE subscriptions s SET s.is_read = 0 WHERE ";
        for ($i = 0; $i < count($names); $i++ ) {
            if ($i + 1 == count($names)) {
                $sql .= "s.id_subscription = $names[$i]";
                break;
            }
            $sql .= "s.id_subscription = $names[$i] and ";
        }
        $res = $this->dbconnect->query($sql);
        return $res;
    }

    /**
     * @param $elements array
     */
    public function addNotificate($elements) {
        $sql = "INSERT INTO notificate (diff, event, id_subs, id_user) VALUES (?, '', ?, ?)";
        $res = $this->dbconnect->prepare($sql);
        for ($i = 0; $i < count($elements); $i++) {
            if (!isset($elements["user"])) {
                continue;
            }
            foreach ($elements[$i]['user'] as $user) {
                $exec = [];
                $exec[] = $elements[$i]["data"];
                $exec[] = $elements[$i]["id_subs"];
                $exec[] = $user["id_user"];
                $res->execute($exec);
            }
        }
    }

    public function getNotificateByUser($user) {
        $sql = "
            SELECT 
                m.name_material,
                n.diff,
                s.is_read
            FROM notificate n INNER JOIN 
                ( subscriptions s INNER JOIN material m on s.material_id = m.id_material) 
            ON s.id_subscription = n.id_subs
            WHERE n.id_user = ?";
        $id = $this->getUserId($user);
        $res = $this->dbconnect->prepare($sql);
        $res->execute([$id]);
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
        if (!$id_user) {
            $id_user = $this->AddUser($login);
        }
        $id_material = $this->getMaterialId($material_name);
        if (!$id_material) {
            if (strpos($material_name, "#")) {
                $id_material = $this->addRessource($material_name);
            } else {
                $id_material = $this->addDocument($material_name);
            }
        }
        $sql = "INSERT INTO `subscriptions`( `user_id`, `material_id`, `is_read`) VALUES (?, ?, 0)";
        $res = $this->dbconnect->prepare($sql);
        return $res->execute([$id_user, $id_material]);
    }

    /**
     * @param $login
     * @return string
     */
    public function AddUser($login) {
        $sql = "INSERT INTO `user`(`login`, `status`) VALUES (?, 'user')";
        $res = $this->dbconnect->prepare($sql);
        $res->execute([$login]);
        return $this->dbconnect->lastInsertId();
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
        return $res->rowCount() ? $res->fetchAll(\PDO::FETCH_ASSOC)[0]['id_user'] : false;
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
            `user`.`id_user` = `offers`.`user_id`";
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
        return $res->rowCount() ? $res->fetchAll(\PDO::FETCH_ASSOC)[0]['id_material'] : false;
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
        if (!$id_material) {
            if (strpos($material_name, "#")) {
                $id_material = $this->addRessource($material_name);
            } else {
                $id_material = $this->addDocument($material_name);
            }
        }
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
        if (!$id_document) {
            $id_document = $this->addDocument($document_name);
        }
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
     * @param $keyword string
     * @param $nameDocument string
     * @return bool
     */
    public function IssetKeyword($keyword, $nameDocument) {
        $id_document = $this->getMaterialId($nameDocument);
        if (!$id_document) {
            $id_document = $this->addDocument($nameDocument);
        }
        $sql = "SELECT *
            FROM keyword inner join material_from_keyword mfk on keyword.id_keyword = mfk.keyword_id
            Where mfk.material_id = ? and keyword.name_keyword = ?";
        $res = $this->dbconnect->prepare($sql);
        $res->execute([$id_document, $keyword]);
        return $res->rowCount();
    }

    /**
     * Добавление документа
     */
    public function addDocument($nameDocument) {
        $sql = "INSERT INTO `material` (`name_material`, `type`) VALUES  (?, 'document')";
        $res = $this->dbconnect->prepare($sql);
        $res->execute([$nameDocument]);
        return $this->dbconnect->lastInsertId();
    }

    public function documentIsset($nameDocument) {
        $sql = "SELECT `id_material` FROM `material` WHERE `name_material` = ?";
        $res = $this->dbconnect->prepare($sql);
        $res->execute([ $nameDocument ]);
        return $res->rowCount();
    }

    /**
     * @param $nameResource
     * @return string
     */
    public function addRessource($nameResource) {
        $sql = "INSERT INTO `material` (`name_material`, `type`) VALUES  (?, 'resource')";
        $res = $this->dbconnect->prepare($sql);
        $res->execute([$nameResource]);
        return $this->dbconnect->lastInsertId();
    }

    /**
     * Отчет по продчтеным подпискам
     * @return array
     */
    public function getReportSubscribe() {
        $sql = "SELECT user.login, material.name_material, s.is_read
            FROM user INNER JOIN (subscriptions s INNER  JOIN material on material.id_material = s.material_id)
               on user.id_user = s.user_id";
        $res = $this->dbconnect->query($sql);
        return $res->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Отчет о предложенных корректировках
     * @return array
     */
    public function getReportOffer() {
        $sql = "SELECT DISTINCT
               u.login,
               (SELECT COUNT(accepted) FROM offers Where accepted = 1 and u.id_user = offers.user_id) as \"accept\",
               (SELECT COUNT(accepted) FROM offers WHERE u.id_user = offers.user_id) as \"count\"
        FROM user u INNER JOIN offers o on u.id_user = o.user_id";
        $res = $this->dbconnect->query($sql);
        return $res->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Возвращает список предложенных изменений пользователя
     * @param $login
     * @return array
     */
    public function getReportUser($login){
        $sql = "SELECT DISTINCT
        u.login,
        m.name_material,
        o.accepted,
        o.diff
        FROM user u INNER JOIN ( offers o INNER JOIN material m on o.material_id = m.id_material ) on u.id_user = o.user_id
        WHERE u.login = ?";
        $res = $this->dbconnect->prepare($sql);
        $res->execute([$login]);
        return $res->fetchAll(\PDO::FETCH_ASSOC);
    }
}
