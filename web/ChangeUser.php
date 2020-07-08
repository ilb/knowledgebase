<?php
/*
 * Description Позволяет админу назначит пользователя ментором 
 */

use config\Config;
use repository\UserRepository;
use usecase\user\ChangeStatus;
use usecase\user\GetUsersList;

require_once '../config/bootstrap.php';
if (isset($_POST['changeBtn'])) {
    $id = $_POST['changeBtn'];
    $status = "status_" . $id;
    $res = new ChangeStatus($id, $_POST[$status]);
    $result = "Произошла непредвиденная ошибка";
    if ( $res->execute() ) {
        $result = "Пользователь теперь является " . $_POST[$status];
    }
}
Config::getHeader();

$repository = new UserRepository(Config::connect());
$userList = new GetUsersList();
$userList->setRepository($repository);
$userList->execute();
?>

<html xmlns="http://www.w3.org/1999/xhtml" lang="ru">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>Изменение пользователя</title>
</head>

<body>
    <div class="container text">
        <?php
        if (isset($result)):
        ?>
        <h4><?=$result?></h4>
        <?php
        endif;
        ?>
        <form action="" method="post">
        <table style="width: 100%">
            <tr>
                <th>Пользователь</th>
                <th>Статус</th>
                <th>Применить</th>
            </tr>
            <?php
                foreach ($userList as $user):
            ?>
                <tr class="resource">
                    <td class="table_font"><?=$user['login']?></td>
                    <td class="table_font">
                        <select name="status_<?=$user['id_user']?>">
                            <option
                                    value="admin"
                                <?= $user['status'] == 'admin' ? "selected='selected'" : null?>>
                                admin
                            </option>
                            <option
                                    value="mentor"
                                <?= $user['status'] == 'mentor' ? "selected='selected'" : null?>>
                                mentor
                            </option>
                            <option
                                    value="user"
                                <?= $user['status'] == 'user' ? "selected='selected'" : null?>>
                                user
                            </option>
                        </select>
                    </td>
                    <td><button name="changeBtn" value="<?=$user['id_user']?>">Изменить</button></td>
                </tr>
            <?php
                endforeach;
            ?>
        </table>
        </form>
    </div>
</body>

</html>