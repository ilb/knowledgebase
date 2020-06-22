<?php
/*
 * Description Формирует отчеты по предложенным изменениям. так же по подпискам
 */

require_once '../config/bootstrap.php';
?>

<div class="box">
    <form action="" method="GET" class="ui form">
        <button type="submit" class="ui button" name="reportSubscriptions">
            Сформировать отчет по подпискам
        </button>
        <button type="submit" class="ui button" name="reportOffer">
            Сформировать отчет по предложенным корректировкам
        </button>   
    </form>
    <div class="center-tabble">
        <table class="ui celled table">
            <?php
            $repo = new \repository\Repository();
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

</div>
