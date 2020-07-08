<?php

require_once '../config/bootstrap.php';

use config\Config;

Config::getHeader();

$files = (scandir('.'));
$clear_files = array();
foreach ($files as $file) {

    if (preg_match("/[*.]php/", $file) && $file != "index.php") {
        $clear_files[] =  $file;
    } else {
        continue;
    }

}
?>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Действия</title>
</head>

<body>
    <div class="container text">
        <form action="documentfind.php" method="post">
            <fieldset>
                <input type="hidden" name="run" value="1" />
                <legend>Список</legend>
                <div>
                    <label>
                        Слово
                        <input type="text" name="keyWord" placeholder="ключевое слово" />
                    </label>
                    <button type="submit" name="search">
                        Поиск
                    </button>
                </div>
            </fieldset>
        </form>
        <table style="width: 100%;">
            <caption>
                Весь список файлов
            </caption>
            <tr style="font-size: 1.3em">
                <th>Наименование</th>
                <th>Описание</th>
            </tr>
            <?php
            foreach ($clear_files as $file) :
            ?>
                <tr class="resource">
                    <td>
                        <a href="<?= $file ?>">
                            <h1 style="font-weight: normal; font-size: 1.2em"><?= $file ?> </h1>
                        </a>
                    </td>
                    <td>
                    </td>
                </tr>
            <?php
            endforeach;
            ?>
        </table>
    </div>
</body>

</html>