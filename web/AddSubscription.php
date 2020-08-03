<?php
/**
 * Description Добавляет пользователю подписки
 */

use config\Config;
use repository\UserRepository;
use usecase\catalog\GetCatalog;
use usecase\user\GetUsersList;

require_once '../config/bootstrap.php';

Config::getHeader();

//Получить список всех пользователей и документов и выбирать кого на что подписать
$repository = new UserRepository(Config::connect());
$userList = new GetUsersList();
$userList->setRepository($repository);
$userList->execute();
$documentList = new GetCatalog("../web/index.html");
$documentList->setRepository($repository);
$catalog = $documentList->execute();
?>
<html  xmlns="http://www.w3.org/1999/xhtml" lang="ru">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>Подписать пользователя</title>
</head>

<body>
    <div class="container text">
        <h1>Не могу придумать дизайн</h1>
    </div>
</body>

</html>