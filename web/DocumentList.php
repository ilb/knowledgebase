<?php
require_once '../web/template/header.php';
/*
 * Выводит список всех документов
 */
ini_set("error_reporting", E_ALL);
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);

require_once '../config/bootstrap.php';

$catalog = new \catalog\Catalog("../web/index.html");
$catalog->createDocuments();
?>
<h1>Список документов</h1>
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
</body>
</html>