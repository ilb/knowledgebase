<?php
/*
 * Description показывает все подписки на которые вы подписаны
 */

use config\Config;
use repository\Repository;
use usecase\subscriptions\SubscriptionView;

require_once '../config/bootstrap.php';


if (isset($_GET['link_to'])) {
    //Прочтена
    $arr = explode("/", $_GET['link_to']);
    $material_name = $arr[count($arr)-1];
    $viewed = new usecase\subscriptions\SubscribtionViewed("User1", $material_name);
    if ($viewed->execute()) {
        header("Location: ". $_GET['link_to']);
    }
    exit("<h2>Что то пошло не так</h2>");
}

Config::getHeader();

$repository = new Repository(Config::connect());
// Передавать логин пользователя
$sub = new SubscriptionView("User1");
$sub->setRepository($repository);
$subscriptions = $sub->execute();
?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>Список подписок</title>
</head>

<body>
    <div class="container text">
        <table>
            <caption>Список подписок</caption>
            <tr>
                <th>
                    Наименование
                </th>
                <th>
                    Прочитано
                </th>
            </tr>
            <?php
            foreach ($subscriptions->getSubscriprions() as $subscription) :
                ?>
                <tr class="resource">
                    <td>
                        <a href="SubscriptionsList.php?link_to=<?=DOMEN . "/" . $subscription->getElement()?>">
                            <h1 class="table_font"><?=$subscription->getElement()?></h1>
                        </a>
                    </td>
                    <td>
                        <h2 class="table_font"><?=$subscription->checkRead() ? "Yes" : "No" ?></h2>
                    </td>
                </tr>
            <?php
            endforeach;
            ?>
        </table>
    </div>
</body>

</html>