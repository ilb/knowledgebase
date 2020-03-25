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
//    $catalog->createDocuments();
?>
    <h1>Список документов</h1>
<?php
    foreach ($catalog->getDocuments() as $document):
        $document->createResources();
        foreach ($document->getResources() as $resource) :
?>
    
    <span class="document"><?=$document->getName()?></span>
    
<?php
        endforeach;
    endforeach;
?>
</body>
</html>