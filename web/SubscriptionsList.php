<?php
/*
 * Description показывает все подписки на которые вы подписаны
 */

use usecase\subscriptions\SubscriptionView;

require_once '../config/bootstrap.php';

header("Content-type: text/xml");
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1 plus MathML 2.0 plus SVG 1.1//EN" 
"http://www.w3.org/2002/04/xhtml-math-svg/xhtml-math-svg-flat.dtd">
<?xml-stylesheet type="text/xsl" href="css/main.xsl"?>';

if (isset($_GET['link_to'])) {
    //Прочтена
}

// Передавать логин пользователя
$sub = new SubscriptionView("User1");
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
                        <a href="SubscriptionsList.php?ling_to=<?=DOMEN?>"><h1 class="table_font"><?=$subscription->getElement()?></h1></a>
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