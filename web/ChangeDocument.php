<?php
/**
 * Description Меняет ссылку документа
 */

use usecase\document\DocumentList;

require_once '../config/bootstrap.php';

header("Content-type: text/xml");
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1 plus MathML 2.0 plus SVG 1.1//EN"
"http://www.w3.org/2002/04/xhtml-math-svg/xhtml-math-svg-flat.dtd">
<?xml-stylesheet type="text/xsl" href="css/main.xsl"?>';

if (isset($_POST['document'])) {
    if (empty(trim($_POST['urlAddr']))) {
        $result = "Ключевое слово не может быть пустым";
    } else {
        // Добавление нового адреса

        $result = "Произошла ошибка";
        /*if ($res->execute()) {
            $result = "Ключевое слово добавлено";
        }
        */
    }
}

// Нужно переделать БД чтобы ссылка на документ менялась с сылкой на ресурс
$documentList = new DocumentList("../web/index.html");
$catalog = $documentList->execute();
?>

<html xmlns="http://www.w3.org/1999/xhtml" lang="ru">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>Измненить URL документа </title>
</head>

<body>
<div class="container text">
    <?php
    if (isset($result)):
        ?>
        <h1><?= $result ?></h1>
    <?php
    endif;
    ?>
    <form action="AddTag.php" method="post">
        <fieldset>
            <legend>Изменения</legend>
            <div>
                <label>
                    Новый URL адрес для документа
                    <input type="text" name="urlAddr" placeholder="Введите URL" style="width: 25%"/>
                </label>
                <label>
                    Документ
                    <select name="document" id="doc">
                        <?php
                        foreach ($catalog->getDocuments() as $document):
                            ?>
                            <option value="<?= $document->getName() ?>"><?= $document->getName() ?></option>
                        <?php
                        endforeach;
                        ?>
                    </select>
                </label>
                <button>Добавить</button>
            </div>
        </fieldset>
    </form>
</div>
</body>

</html>
