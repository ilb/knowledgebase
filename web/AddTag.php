<?php
/**
 * Description Добавляет ключевые слова
 */


use config\Config;
use repository\Repository;
use usecase\catalog\GetCatalog;
use usecase\document\DocumentAddTag;

require_once '../config/bootstrap.php';

Config::getHeader();

$repository = new Repository(Config::connect());
if (isset($_POST['document'])) {
    if (empty(trim($_POST['keyWord']))) {
        $result = "Ключевое слово не может быть пустым";
    } else {
        $res = new DocumentAddTag($_POST['document'], $_POST['keyWord']);
        $res->setRepository($repository);
        $result = "Произошла ошибка";
        if ($res->execute()) {
            $result = "Ключевое слово добавлено";
        }
    }
}

$documentList = new GetCatalog("../web/index.html");
$documentList->setRepository($repository);
$catalog = $documentList->execute();
?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>Добавление ключевых слов</title>
</head>

<body>
<div class="container text">
    <?php
    if (isset($result)):
        ?>
    <h1><?=$result?></h1>
    <?php
    endif;
    ?>
    <form action="AddTag.php" method="post">
        <fieldset>
            <legend>Список</legend>
            <div>
                <label>
                    Новое ключевое слово
                    <input type="text" name="keyWord" placeholder="Введите ключевое слово"/>
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