<?php

/**
 * Для работы с базой данной
 */

namespace repository;

class Repository {

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
        $res = $this->dbconnect->prepare("SELECT
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
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * SELECT
            `subscriptions`.`is_read`,
            `material`.`name_material`,
            `material`.`source`
        FROM
            `user`
        INNER JOIN(
                `subscriptions` INNER JOIN `material` ON `subscriptions`.`material_id` = `material`.`id_material`
            )
        ON
            `user`.`id_user` = `subscriptions`.`user_id`
        WHERE 
                `user`.`login` = ""
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
        $answ = $res->fetchAll(\PDO::FETCH_ASSOC);
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
        return $answ;
    }

    /**
     * SELECT
      `document`.`name_document`,
      `document`.`source_document`
      FROM
      `document`
      INNER JOIN(
      `document_to_keyword`
      INNER JOIN `keyword` ON `document_to_keyword`.`keyword_id` = `keyword`.`id_keyword`
      )
      ON
      `document_to_keyword`.`document_id` = `document`.`id_document`
      WHERE
      `keyword`.`name_keyword` = ?
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

}
