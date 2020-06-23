<?php
/*
 * Description Позволяет админу назначит пользователя ментором 
 */

use usecase\user\ChangeStatus;
use usecase\user\UsersList;

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
header("Content-type: text/xml");
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1 plus MathML 2.0 plus SVG 1.1//EN"
"http://www.w3.org/2002/04/xhtml-math-svg/xhtml-math-svg-flat.dtd">
<?xml-stylesheet type="text/xsl" href="css/main.xsl"?>';

$userList = UsersList::execute();
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