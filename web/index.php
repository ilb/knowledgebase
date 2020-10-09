<?php

use config\Config;

require_once '../config/bootstrap.php';

header("Location: file://" . Config::getInstance()->filespath);