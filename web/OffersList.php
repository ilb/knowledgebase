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

<div class="box"> 
    <h1>Предложенные изменения</h1>
    <div class="center-tabble">
        <table>
            <tr>
                <th>
                    Пользователь
                </th>
                <th>
                   Именения
                </th>
                <th>
                    Принять
                </th>
                <th>
                    Отклонить
                </th>
            </tr>
            <tr>
                <td>
                  User1  
                </td>
                <td>
                    <a href="#">
                        Посмотреть
                    </a>
                </td>
                <td>
                    <a href="#">
                        Принять
                    </a>
                </td>
                <td>
                    <a href="#">
                        Отклонить
                    </a>
                </td>                
            </tr>
        </table>
    </div>
</div>

<?php
require_once "../web/template/footer.php";
