<?php
/**
 * Description Выводит список всех документов и ресурсов
 */

use usecase\document\DocumentList;

require_once '../config/bootstrap.php';

header("Content-type: text/xml");
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1 plus MathML 2.0 plus SVG 1.1//EN" 
"http://www.w3.org/2002/04/xhtml-math-svg/xhtml-math-svg-flat.dtd">
<?xml-stylesheet type="text/xsl" href="css/main.xsl"?>';

$documentList = new DocumentList("../web/index.html");
$catalog = $documentList->execute();
?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
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