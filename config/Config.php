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
    const DBPASSWORD = "";

    /**
     * Имя базы данных которую подключаем
     * @var string
     */
    const DBNAME = "knowledgebase";

    /**
     * Возвращает сооединение с БД
     * @return PDO
     */
    public static function connect() {
        return new PDO("mysql:host=" . self::DBHOST . ";dbname=" . self::DBNAME, self::DBUSER, self::DBPASSWORD);
    }

    public static function getHeader() {
        header("Content-type: text/xml");
        echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1 plus MathML 2.0 plus SVG 1.1//EN"
            "http://www.w3.org/2002/04/xhtml-math-svg/xhtml-math-svg-flat.dtd">
                <?xml-stylesheet type="text/xsl" href="stylesheets/main.xsl"?>';
    }
}