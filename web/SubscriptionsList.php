<?php
require_once '../web/template/header.php';
/*
 * Выводит список всех документов
 */

require_once '../config/bootstrap.php';

$sub = new \usecase\subscriptions\SubscriptionView("User1");
$subscriptions = $sub->execute();
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
                    Прочитано
                </th>
                <th>
                    Ссылка
                </th>
            </tr>
            <?php
            foreach ($subscriptions->getSubscriprions() as $subscription) :
            ?>
            <tr>
                <td><?=$subscription->getElement()?></td>
                <td><?=$subscription->checkRead() ? "Yes" : "No" ?></td>
                <td> <a href="#"> Ссылка на чтение</a></td>
            </tr>
            <?php
            endforeach;
            ?>
        </table>
    </div>
</div>

<?php
require_once "../web/template/footer.php";
