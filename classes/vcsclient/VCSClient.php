<?php

namespace vcsclient;

interface VCSClient {
    /**
     * Обновляет репозиторий
     * @return mixed
     */
    public function update();

    /**
     * Делает коммит репозитория
     * @param $msg string
     * @return mixed
     */
    public function commit($msg);
}