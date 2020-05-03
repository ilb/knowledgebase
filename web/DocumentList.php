<?php
require_once '../web/template/header.php';
/*
 * Выводит список всех документов
 */
ini_set("error_reporting", E_ALL);
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);

require_once '../config/bootstrap.php';

$documentList = new \usecase\document\DocumentList("../web/index.html");
$catalog = $documentList->execute();
?>
<div class="box">
    <h1>Список документов</h1>
    <form action="DocumentFind.php" method="post">
        <input type="text" name="keyWord" class='search' placeholder="Поиск по ключевому слову">
        <button type="submit" name="search">
            Поиск
        </button>
        <!--<button>Создать документ</button>-->
    </form> 
    <div class="center-tabble">
        <table>
            <tr>
                <th>Наименование</th>
                <th>Ссылка на материал</th>
                <th>Тип материала</th>
            </tr>
            <?php
            foreach ($catalog->getDocuments() as $document):
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
    </div>
</div>
<?php
require_once "../web/template/footer.php";
