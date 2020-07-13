<?php
/**
 * Description Выводит список всех документов и ресурсов
 */

use config\Config;
use usecase\catalog\GetCatalog;

require_once '../config/bootstrap.php';

Config::getHeader();

$documentList = new GetCatalog("../web/index.html");
$catalog = $documentList->execute();
?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru">

<head>
    <title>Список документов</title>
</head>

<body>
    <div class="container text">
        <form action="DocumentFind.php" method="post">
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
                Весь список ресурсов и документов
            </caption>
            <tr style="font-size: 1.3em">
                <th>Наименование</th>
                <th>Тип материала</th>
            </tr>
            <?php
            foreach ($catalog->getDocuments() as $document) :
                $document->createResources();
            ?>
                <tr class="document">
                    <td>
                        <a href="<?= $document->getSource() ?>" target="__blank">
                            <h1 class="table_font"><?= $document->getName() ?> </h1>
                        </a>
                    </td>
                    <td>Документ</td>
                </tr>
                <?php
                foreach ($document->getResources() as $resource) :
                ?>
                    <tr class="resource">
                        <td>
                            <a href="<?= $document->getSource() . "#" . $resource->getTag() ?>" target="__blank">
                                <h2 class="table_font"><?= $resource->getTag() ?></h2>
                            </a>
                        </td>
                        <td>Ресурс</td>
                    </tr>
            <?php
                endforeach;
            endforeach;
            ?>
        </table>
    </div>
</body>

</html>