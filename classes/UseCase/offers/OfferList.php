<?php

/*
 * Показывает список всех внесенных изменений
 */

namespace usecase\offers;

use repository\Repository;

class OfferList {
    
    public static function execute() {
        $repo = new Repository();
        return $repo->getOffersList();
    }
    
}
