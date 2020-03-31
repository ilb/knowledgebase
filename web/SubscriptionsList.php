<?php
require_once '../web/template/header.php';
/*
 * Выводит список всех документов
 */
ini_set("error_reporting", E_ALL);
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);

require_once '../config/bootstrap.php';

$sub = new \usecase\subscriptions\SubscriptionView();
?>

<div class="ui two column grid container">
    <div class="two column row">
        <div class="column">
            <div class="ui vertical menu">
                <a class="item active text-green">
                    Все подписки
                    <div class="ui label " >30</div>
                </a>
                <a class="item  text-red">
                    Обновленные
                    <div class="ui label">4</div>
                </a>
            </div>
        </div>
        <div class="column">
            Тут будут отображатся подписки
        </div>
    </div>
</div>

<?php
require_once "../web/template/footer.php";
