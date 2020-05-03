<?php
require_once '../web/template/header.php';
/*
 * Выводит список всех документов
 */
ini_set("error_reporting", E_ALL);
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);

require_once '../config/bootstrap.php';

$sub = new \usecase\subscriptions\SubscriptionView();
?>

<div class="box">
    <div class="center-tabble">
        <table>
            <tr>
                <th>
                    Наименование
                </th>
                <th>
                    Ссылка
                </th>
                <th>
                    Прочитано
                </th>
            </tr>
            <tr>
                <td>ddd.xhtml</td>
                <td><a href="#">Прочитать</a></td>
                <td>Ознакомлен</td>
            </tr>
            <tr>
                <td>productmanagement.xhtml</td>
                <td><a href="#">Прочитать</a></td>
                <td>Не прочитано</td>
            </tr>
        </table>
    </div>
</div>

<?php
require_once "../web/template/footer.php";
