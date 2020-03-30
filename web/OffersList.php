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
    <h1>Предложенные изменения</h1>
    <div class="ui cards">
        <div class="card">
            <div class="content">
                <img class="right floated mini ui image" src="https://picsum.photos/200/200">
                <div class="header">
                    Имя пользователя
                </div>
                <div class="description">
                    Внесение в документ: <u>Имя документа</u>
                    Изменения: <a class="ui" target="__blank">Посмотреть</a>
                </div>
            </div>
            <div class="extra content">
                <div class="ui two buttons">
                    <div class="ui basic green button">Принять</div>
                    <div class="ui basic red button">Отклонить</div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once "../web/template/footer.php";
