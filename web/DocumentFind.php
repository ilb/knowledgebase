<?php
/**
 * Description Выводит список всех найденных ресурсов по ключевому слову
 */

use usecase\document\DocumentSearch;

require_once '../config/bootstrap.php';

header("Content-type: text/xml");
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1 plus MathML 2.0 plus SVG 1.1//EN" 
"http://www.w3.org/2002/04/xhtml-math-svg/xhtml-math-svg-flat.dtd">
<?xml-stylesheet type="text/xsl" href="css/main.xsl"?>';

$results = [];
$value = "";
if (isset($_POST['keyWord'])) {
    $value = $_POST['keyWord'];
    $df = new DocumentSearch("../web/index.html", $_POST['keyWord']);
    $results = $df->execute();
}

?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>Поиск</title>
</head>

<body>
<div class="container text">
    <form action="DocumentFind.php" method="post">
        <fieldset>
            <input type="hidden" name="run" value="1"/>
            <legend>Список</legend>
            <div>
                <label>
                    Слово
                    <input type="text" name="keyWord" placeholder="ключевое слово" value="<?=$value?>"/>
                </label>
                <button type="submit" name="search">
                    Поиск
                </button>
            </div>
        </fieldset>
    </form>
    <?php
    if (empty($results)) :
        ?>
        <h1 class="err">Ничего не найдено</h1>
    <?php
    else :
        ?>
        <table style="width: 100%;">
            <caption>
                Весь список ресурсов и документов
            </caption>
            <tr style="font-size: 1.3em">
                <th>Имя документа</th>
                <th>Ресурс документа</th>
            </tr>
            <?php
            foreach ($results as $result) :
                $arr = explode("/", $result['link']);
                $result['desc'] = $arr[count($arr) - 1];
                ?>
                <tr class="resource">
                    <td>
                        <a href="<?= $result['link'] ?>" target="__blank">
                            <h1 class="table_font"><?= $result['document']->getName() ?></h1>
                        </a>
                    </td>
                    <td>
                        <h2 class="table_font"><?= $result['desc'] ?></h2>
                    </td>
                </tr>
            <?php
            endforeach;
            ?>
        </table>
    <?php
    endif;
    ?>
</div>
</body>

</html>