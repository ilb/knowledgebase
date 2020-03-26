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
     * SELECT
      `material`.`name_material` AS `name`,
      `material`.`source`,
      `user`.`login`
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
    public function getSubscribtions($login) {
        $sql = "SELECT
                    `material`.`name_material` AS `name`,
                    `material`.`source`,
                    `user`.`login`
                FROM
                    `user`
                    INNER JOIN(
                        `subscriptions` INNER JOIN `material` ON `subscriptions`.`material_id` = `material`.`id_material`
                    )
                ON
                    `user`.`id_user` = `subscriptions`.`user_id`
                WHERE
                    `user`.`login` = ?";
        $res = $this->dbconnect->prepare($sql);
        return $res->execute([$login]);
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
