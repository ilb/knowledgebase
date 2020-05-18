<?php
require_once '../web/template/header.php';
/*
 * Выводит список всех документов
 */

require_once '../config/bootstrap.php';

$sub = new \usecase\subscriptions\SubscriptionView("User1");
$subscription = $sub->execute();
?>

<div class="box">
    <h1>Список подписок</h1>
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
