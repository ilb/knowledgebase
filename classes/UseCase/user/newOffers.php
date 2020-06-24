<?php


namespace usecase\user;


class newOffers {

    /**
     * Логин пользователя
     * @var string
     */
    private $login;

    /**
     * Имя материала предложенного на корректировку
     * @var string
     */
    private $name_material;

    /**
     * Изменения
     * @var string
     */
    private $diff;

    /**
     * newOffers constructor.
     * @param $login
     * @param $name_material
     * @param $diff
     */
    public function __construct($login, $name_material, $diff) {
        $this->login = $login;
        $this->name_material = $name_material;
        $this->diff = $diff;
    }

    public function execute() {

    }


}