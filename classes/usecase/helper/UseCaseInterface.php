<?php


namespace usecase\helper;


interface UseCaseInterface {
    /**
     * @return array[]|\response\Response
     */
    public function execute();
}