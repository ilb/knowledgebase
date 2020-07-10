<?php
/*
 * Description Выводит список всех документов и ресурсов предложенных на изменение
 */

use config\Config;
use usecase\offers\GetOfferList;

require_once '../config/bootstrap.php';

Config::getHeader();

$repository = new \repository\Repository(Config::connect());
$offerList = new GetOfferList();
$offerList->setRepository($repository);
$offerList = $offerList->execute();
?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>Список предложенных документов</title>
</head>

<body>
<div class="container text">
    <?php
    if (!empty($offerList)):
        ?>
        <table>
            <caption>Предложенные корректировки</caption>
            <tr>
                <th>Пользователь</th>
                <th>Материал</th>
                <th>Изменения</th>
                <th>Принять</th>
                <th>Отклонить</th>
            </tr>
            <?php
            foreach ($offerList as $offer):
                ?>
                <tr>
                    <td><?= $offer['login'] ?></td>
                    <td><a href="<?= $offer['source'] ?>"><?= $offer['name_material'] ?></a></td>
                    <td><?= $offer['diff'] ?></td>
                    <td><a href="#">Применить</a></td>
                    <td><a href="#">Отклонить</a></td>
                </tr>
            <?php
            endforeach;
            ?>
        </table>
    <?php
    else:
        ?>
        <h2>нет предложенных изменений</h2>
    <?php
    endif;
    ?>
</div>
</body>

</html>
