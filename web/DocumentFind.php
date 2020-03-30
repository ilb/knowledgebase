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
<div class="container ui">
    <div class="ui cards">
        <?php
        if (empty($results)):
            ?>

            <h1 id="err">Ничего не найдено</h1>
            <?php
        else:
            foreach ($results as $result) :
                $arr = explode("/", $result['link']);
                $result['desc'] = $arr[count($arr) - 1];
                ?>

                <div class="card"> 
                    <div class="content">
                        <div class="header">
                            <h2> В документе </h2> 
                            <u><?= $result['document']->getName() ?></u>
                        </div>
                        <div class="description">
                            <p><?= $result['desc'] ?></p>
                            <a <?= $result['desc'] ?>href="<?= $result['link'] ?>" target="__blank" class="ui button"> Прочитать </a>
                        </div>
                    </div>
                </div>

                <?php
            endforeach;
        endif;
        ?>

    </div>
</div>
<?php
require_once '../web/template/footer.php';
