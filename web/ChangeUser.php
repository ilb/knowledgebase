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

$repository = new UserRepository(Config::getInstance()->connection);
if (isset($_POST['changeBtn'])) {
    $id = $_POST['changeBtn'];
    $status = "status_" . $id;

    $newStatus = $_POST[$status];

    $result = "Произошла непредвиденная ошибка";

    if ($newStatus !== 'admin') {
	$res = new ChangeStatus($id, $newStatus);
	$res->setRepository($repository);
	if ($res->execute()) {
	    $result = "Пользователь теперь является " . $newStatus;
	}
    }
}

$userList = new GetUsersList();
$userList->setRepository($repository);
$userList = $userList->execute();

$serialize = new Serialize();
$xml = $serialize->arrToXMLandXSL($userList, "stylesheets/User/ChangeUser.xsl");
header("Content-type: text/xml");
echo $xml;
