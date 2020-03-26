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
    <input type="text" name="keyWord" class="search" placeholder="Введите ключевое слово">
    <label for="search_button"> 
        <img alt="Поиск" src="assets/img/search.png"> 
    </label>
    <input type="submit" id="search_button">
</form> 
<main>
    <?php
    foreach ($catalog->getDocuments() as $document):
        $document->createResources();
        ?>

        <div class="level1">
            <h3>Документ</h3> <a href="<?= $document->getSource() ?>"><u><?= $document->getName() ?></u></a>
            <div class="level2">

                <?php
                foreach ($document->getResources() as $resource) :
                    ?>

                    <h4>Ресурс</h4> <a href="<?= $document->getSource() . "#" . $resource->getTag() ?>"><?= $resource->getName() ?></a>

                    <?php
                endforeach;
                ?>

            </div>
        </div>

        <?php
    endforeach;
    ?>
</main>

<?php
require_once "../web/template/footer.php";
?>
</body>
</html>