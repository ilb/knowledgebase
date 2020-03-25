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
     * SELECT `user`.`login` FROM `user` INNER JOIN `subscriptions` ON `subscriptions`.`user_id` = `user`.`id_user`
     * @return array 
     */
    public function getSubscribtions() {
        return [
            []
        ];
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
