<?php


namespace config;


use PDO;

class Config {

    /**
     * Хост на котором располагается DB
     * @var string
     */
    const DBHOST = "localhost";

    /**
     * Пользователь имеющий доступ к DB
     * @var string
     */
    const DBUSER = "root";

    /**
     * Пароль пользователя для доступа DB
     * @var string
     */
    const DBPASSWORD = "gfhjkm";

    /**
     * Имя базы данных которую подключаем
     * @var string
     */
    const DBNAME = "knowledgebase";


    /**
     * Путь до файлов базы знаний
     * @var string
     */
    const pathToKnowledgebase = "/var/apps/knowledgebase";

    /**
     * Возвращает сооединение с БД
     * @return PDO
     */
    public static function connect() {
        return new PDO("mysql:host=" . self::DBHOST . ";dbname=" . self::DBNAME, self::DBUSER, self::DBPASSWORD);
    }
}