<?php
/**
 * Description Добавляет пользователю подписки
 */

use usecase\document\DocumentList;
use usecase\user\UsersList;

require_once '../config/bootstrap.php';

header("Content-type: text/xml");
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1 plus MathML 2.0 plus SVG 1.1//EN"
"http://www.w3.org/2002/04/xhtml-math-svg/xhtml-math-svg-flat.dtd">
<?xml-stylesheet type="text/xsl" href="css/main.xsl"?>';

//Получить список всех пользователей и документов и выбирать кого на что подписать
$userList = UsersList::execute();
$documentList = new DocumentList("../web/index.html");
$catalog = $documentList->execute();
?>
<html  xmlns="http://www.w3.org/1999/xhtml" lang="ru">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>Подписать пользователя</title>
</head>

<body>
    <div class="container text">
        <h1>Как то не сложилось</h1>
    </div>
</body>

</html>