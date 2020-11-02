<?php

namespace vcsclient;

interface VCSClient {
    /**
     * Обновляет репозиторий
     * @return mixed
     */
    public function update();

    /**
     * @param $file
     * @return mixed
     */
    public function add($file);

    /**
     * Делает коммит репозитория
     * @param $msg string
     * @return mixed
     */
    public function commit($msg);

    /**
     * Информация о URL
     * @param $file
     * @return mixed
     */
    public function info($file);
}