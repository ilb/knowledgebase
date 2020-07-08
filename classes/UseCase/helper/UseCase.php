<?php


namespace usecase\helper;


abstract class UseCase implements UseCaseInterface {

    /**
     * @var \repository\Repository
     */
    protected $repository;

    /**
     * @param $repository \repository\Repository
     */
    public function setRepository($repository) {
        $this->repository = $repository;
    }
}