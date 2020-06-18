<?php
require_once '../config/bootstrap.php';

header("Content-type: text/xml");

echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1 plus MathML 2.0 plus SVG 1.1//EN" 
"http://www.w3.org/2002/04/xhtml-math-svg/xhtml-math-svg-flat.dtd">
<?xml-stylesheet type="text/xsl" href="css/oooxhtml.xsl"?>';

$documentList = new \usecase\document\DocumentList("../web/index.html");
$catalog = $documentList->execute();
?>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Список документов</title>
</head>

<body>
    <form action="DocumentFind.php" method="post">
        <input type="text" name="keyWord" class='search' placeholder="Поиск по ключевому слову" />
        <button type="submit" name="search">
            Поиск
        </button>
        <!--<button>Создать документ</button>-->
    </form>
    <table>
        <tr>
            <th>Наименование</th>
            <th>Ссылка на материал</th>
            <th>Тип материала</th>
        </tr>
        <?php
        foreach ($catalog->getDocuments() as $document) :
            $document->createResources();
        ?>
            <tr>
                <td><?= $document->getName() ?> </td>
                <td><a href="<?= $document->getSource() ?>" target="__blank">Просмотреть</a></td>
                <td>Документ</td>
            </tr>
            <?php
            foreach ($document->getResources() as $resource) :
            ?>
                <tr>
                    <td><?= $resource->getTag() ?> </td>
                    <td><a href="<?= $document->getSource() . "#" . $resource->getTag() ?>" target="__blank">Просмотреть</a></td>
                    <td>Ресурс</td>
                </tr>
        <?php
            endforeach;
        endforeach;
        ?>
    </table>
</body>

</html>
