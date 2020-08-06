<?php
/*
 * Description Позволяет админу назначит пользователя ментором 
 */

use config\Config;
use repository\UserRepository;
use serialize\Serialize;
use usecase\user\ChangeStatus;
use usecase\user\GetUsersList;

require_once '../config/bootstrap.php';

$repository = new UserRepository(Config::connect());
if (isset($_POST['changeBtn'])) {
    $id = $_POST['changeBtn'];
    $status = "status_" . $id;
    $res = new ChangeStatus($id, $_POST[$status]);
    $res->setRepository($repository);
    $result = "Произошла непредвиденная ошибка";
    if ( $res->execute() ) {
        $result = "Пользователь теперь является " . $_POST[$status];
    }
}

$userList = new GetUsersList();
$userList->setRepository($repository);
$userList = $userList->execute();

$serialize = new Serialize();
$xml = $serialize->arrToXMLandXSL($userList, "stylesheets/User/ChangeUser.xsl");
header("Content-type: text/xml");
echo $xml;
