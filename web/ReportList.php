<?php
/*
 * Description Формирует отчеты по предложенным изменениям. так же по подпискам
 */

use config\Config;
use repository\Repository;
use ru\ilb\knowledgebase\ReportList;

require_once '../config/bootstrap.php';

$hreq = new HTTP_Request2Xml("schemas/command.xsd", null, "ReportList");
$req = new ReportList();
if (!$hreq->isEmpty()) {
    $hreq->validate();
    $req->fromXmlStr($hreq->getAsXML());
}

?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>Формирование отчетов</title>
</head>

<body>
    <div class="container text">
        <form action="ReportList.php" method="get">
            <fieldset>
                <legend>Отчет</legend>
                <div>
                    <button type="submit" name="typeReport" value="subscription">
                        Сформировать отчет по подпискам
                    </button>
                    <button type="submit" name="typeReport" value="offer">
                        Сформировать отчет по предложенным корректировкам
                    </button>
                </div>
            </fieldset>
        </form>
        <table class="ui celled table">
            <?php
            $repo = new Repository(Config::connect());
            if (isset($_GET['reportSubscriptions'])):
                $resultArr = $repo->getSubscribtions();
//                $resultArr = $subs->getSubscriprions();
                ?>
                <thead>
                <tr>
                    <th>Логин пользователя</th>
                    <th>Наименование подписки</th>
                    <th>Сслыка</th>
                    <th>Прочитано</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($resultArr as $subscription):
                    ?>

                    <tr>
                        <td data-label='login'><?= $subscription['login'] ?></td>
                        <td data-label='name_material'><?= $subscription['name'] ?></td>
                        <td data-label='link'><a href="#"><?= $subscription['source'] ?></a></td>
                        <td data-label='readed'>
                            <?=
                            $subscription['is_read'] ?
                                '<span class="text-green">Прочитано</span>' :
                                '<span class="text-red">Не прочитано</span>'
                            ?>
                        </td>
                    </tr>

                <?php
                endforeach;
                ?>
                </tbody>
            <?php
            elseif (isset($_GET['reportOffer'])):
                ?>
                <thead>
                <tr>
                    <th>Логин пользователя</th>
                    <th>Всего предложенных правок</th>
                    <th>Отклоненно \ принято</th>
                </tr>
                </thead>
                <tbody>
                <?php
                //                    foreach ($array as $value):
                ?>
                <tr>
                    <td data-label='login'></td>
                    <td data-label='offers'></td>
                    <td data-label='accepted'></td>
                </tr>
                <?php
                //                    endforeach;
                ?>

                </tbody>
            <?php
            endif;
            ?>
        </table>
    </div>
</body>

</html>
