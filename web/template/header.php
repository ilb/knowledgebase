<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DocumentList</title>
    <link rel="stylesheet" href="css/oooxhtml.css" />
    <link rel="stylesheet" href="css/main.css" />
    <link rel="shortcut icon" href="assets/img/pCIQeJeeRck.png" type="image/png">
</head>

<body>
    <header>
        <nav>
            <a class="item" href="DocumentList.php">
                Лист документов
            </a>
            <a class="item" href="SubscriptionsList.php">
                Подписки
            </a>
            <a class="item" href="OffersList.php">
                Лист правок
            </a>
            <a class="item" href="ReportList.php">
                Формирование отчетов
            </a>
            <a class="item" href="ChangeUser.php">
                Управление пользователями
            </a>
            <div class="right">
                <div class="item">
                    <h3> %Пользователь% </h3>
                </div>
                <a href="#">
                    Выход
                </a>
            </div>
        </nav>

    </header>

    <hr class="mb-4">
    <?php
// DEBUG 
    ini_set("error_reporting", E_ALL);
    ini_set("display_errors", 1);
    ini_set("display_startup_errors", 1);
    ?>