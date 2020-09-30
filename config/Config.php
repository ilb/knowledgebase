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
     * СОединение с БД
     * @var \PDO
     */
    public $connection;

    /**
     * Инициализация конифурации.
     */
    private function __construct() {
        $this->filespath = $_SERVER['apps.knowledgebase.filespath'];
        $this->connection =  new PDO(
            "mysql:host=localhost" .
            ";dbname=" . $_SERVER['.apps.knowledgebase.db'],
            $_SERVER['apps.knowledgebase.db_USER'],
            $_SERVER['.apps.knowledgebase.db_PASSWORD']);
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