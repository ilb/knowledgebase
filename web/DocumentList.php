<?php
require_once '../web/template/header.php';
/*
 * Выводит список всех документов
 */
ini_set("error_reporting", E_ALL);
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);

require_once '../config/bootstrap.php';

$documentList = new usecase\document\DocumentList("../web/index.html");
$catalog = $documentList->execute();
$catalog->createDocuments();
?>
<h1>Список документов</h1>
<form class="search" action="DocumentFind.php" method="post">
    <div class="ui icon input">
        <input type="text" name="keyWord" placeholder="Поиск key word">
        <label for="search_button"><i class="circular search link icon"></i></label>
    </div>
    <input type="submit" id="search_button">
</form> 
<div class="ui list">

    <?php
    foreach ($catalog->getDocuments() as $document):
        $document->createResources();
        ?>
        <div class="item">
            <i class="folder icon"></i>
            <div class="content">
                <div class="header">Документ: <?= $document->getName() ?></div>
                <div class="description"><a href="<?= $document->getSource() ?>" target="__blank">Просмотреть документ</a></div>
                <div class="list">
                    <?php
                    foreach ($document->getResources() as $resource) :
                        ?>
                        <div class="item">
                            <i class="file icon"></i>
                            <div class="content">
                                <div class="header">Ресурс: <?= $resource->getTag() ?></div>
                                <div class="description"><a target="__blank" href="<?= $document->getSource() . "#" . $resource->getTag() ?>">Посмотреть</a></div>
                            </div>
                        </div>
                        <?php
                    endforeach;
                    ?>
                </div>
            </div>
        </div>
        <?php
    endforeach;
    ?>
</div>

<?php
require_once "../web/template/footer.php";
?>
</body>
</html>