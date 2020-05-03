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
<div class="box">
    <div class="ui cards">
        <?php
        if (empty($results)):
            ?>

            <h1 id="err">Ничего не найдено</h1>
            <?php
        else:
            ?>
            <div class="center-tabble">
                <table>
                    <tr>
                        <th>
                            Имя документа
                        </th>
                        <th>
                            Ссылка 
                        </th>
                        <th>
                            Ресурс документа
                        </th>
                    </tr>
                    <?php
                    foreach ($results as $result) :
                        $arr = explode("/", $result['link']);
                        $result['desc'] = $arr[count($arr) - 1];
                        ?>
                        <tr>
                            <td>
                                <?= $result['document']->getName() ?>
                            </td>
                            <td>
                                <a href="<?= $result['link'] ?>" target="__blank" > Прочитать </a> 
                            </td>
                            <td>
                                <?= $result['desc'] ?>
                            </td>
                        </tr>                            
                        <?php
                    endforeach;
                    ?>
                </table>
            </div>
        <?php
        endif;
        ?>

    </div>
</div>
<?php
require_once '../web/template/footer.php';
