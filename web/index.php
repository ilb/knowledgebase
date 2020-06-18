<?php
header("Content-type: text/xml");

echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1 plus MathML 2.0 plus SVG 1.1//EN" 
"http://www.w3.org/2002/04/xhtml-math-svg/xhtml-math-svg-flat.dtd">
<?xml-stylesheet type="text/xsl" href="css/main.xsl"?>';

$files = (scandir('.'));
$clear_files = array();
$description_files = array();
foreach ($files as $file) {

    if (preg_match("/[*.]php/", $file) && $file != "index.php") {
        $clear_files[] =  $file;
    } else {
        continue;
    }

    $f = fopen($file, "r");
    $i = 0;
    while (($buffer = fgets($f, 4096)) !== false) {
        if (preg_match("/(Description)/", $buffer, $mathes)) {
            $description_files[$file] = $buffer;
            break;
        }
    }
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Действия</title>
</head>

<body>
    <div class="container text">
        <form action="documentfind.php">
            <fieldset>
                <input type="hidden" name="run" value="1" />
                <legend>Список</legend>
                <div>
                    <label>
                        Слово
                        <input type="text" name="keyWord" placeholder="ключевое слово" />
                    </label>
                    <button type="submit" name="search">
                        Поиск
                    </button>
                </div>
            </fieldset>
        </form>
        <table style="width: 100%;">
            <caption>
                Весь список файлов
            </caption>
            <tr style="font-size: 1.3em">
                <th>Наименование</th>
                <th>Описание</th>
            </tr>
            <?php
            foreach ($clear_files as $file) :
            ?>
                <tr class="resource">
                    <td>
                        <a href="<?= $file ?>" target="__blank">
                            <h1 style="font-weight: normal; font-size: 1.2em"><?= $file ?> </h1>
                        </a>
                    </td>
                    <td>
                        <?= $description_files[$file] ?>
                    </td>
                </tr>
            <?php
            endforeach;
            ?>
        </table>
    </div>
</body>

</html>