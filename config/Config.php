<?php


namespace config;


use PDO;

class Config {

    /**
     * Экземпляр класса
     * @var Config
     */
    private static $Instance;

    /**
     * Путь к файлам
     * @var string
     */
    public $filespath;

    /**
     * Логин пользователя
     * @var string
     */
    public $login;

    /**
     * СОединение с БД
     * @var \PDO
     */
    public $connection;

    /**
     * Инициализация конифурации.
     */
    private function __construct() {
        $this->login = $_SERVER['REMOTE_USER'];
        $this->filespath = $_SERVER['apps.knowledgebase.filespath'];
        $DBConfig = \DB_Config::constructFromConnectionString($_SERVER['.apps.knowledgebase.db'])
            ->setUser($_SERVER['apps.knowledgebase.db_USER'])
            ->setPass($_SERVER["apps.knowledgebase.db_PASSWORD"]);
        $this->connection = \DB_PDOFactory::getInstance()->getPDO($DBConfig, array(\PDO::ATTR_PERSISTENT => false, \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
    }

    /**
     * Получить экземпляр класса
     * @return Config
     */
    public static function getInstance() {
        if (!self::$Instance) {
            self::$Instance = new Config();
        }
        return self::$Instance;
    }
}