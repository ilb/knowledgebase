<?php
/**
 * Description Добавляет пользователю подписки
 */

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
