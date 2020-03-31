<?php
require_once '../web/template/header.php';
/*
 * Выводит список всех документов
 */
ini_set("error_reporting", E_ALL);
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);

require_once '../config/bootstrap.php';
?>

<div class="ui container">
    <div class="centered ui grid mb-4">
        <form action="" method="GET" class="ui form">
            <button type="submit" class="ui button" name="reportSubscriptions">
                Сформировать отчет по подпискам
            </button>
            <button type="submit" class="ui button" name="reportOffer">
                Сформировать отчет по предложенным корректировкам
            </button>   
        </form>
    </div>
    <div class="container">
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
                            <td data-label='link'><?= $subscription['source'] ?></td>
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

<?php
require_once "../web/template/footer.php";
