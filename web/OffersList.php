<?php
require_once '../web/template/header.php';
/*
 * Description Выводит список всех документов и ресурсов предложенных на изменение
 */

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
