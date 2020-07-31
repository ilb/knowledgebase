<?php

/*
 * Показывает список всех внесенных изменений
 */

namespace usecase\offers;

use usecase\helper\UseCase;

class GetOfferList extends UseCase {
    
    public function execute() {
        return $this->repository->getOffersList();
    }
    
}
