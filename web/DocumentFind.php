<?php
require_once '../web/template/header.php';
/*
 * ПОиск документов ?? 
 */
ini_set("error_reporting", E_ALL);
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);

require_once '../config/bootstrap.php';

$df = new \usecase\document\DocumentSearch("../web/index.html", $_POST['keyWord']);

$results = $df->execute();
?>
<main>
    <?php
    if (empty($results)) :
        ?>

        <h1 id="err">Ничего не найдено</h1>
        <?php
    else:
        foreach ($results as $result) :
            ?>

            <div class="level2"> 
                <h2>Найденно:</h2> <a href="<?= $result['link'] ?>" target="__blank"> <?= $result['link'] ?> </a>
                <h2> В документе </h2> <?= $result['document']->getName() ?>
            </div>

            <?php
        endforeach;
    endif;
    ?>

</main>
<?php
require_once '../web/template/footer.php';
