<?php


namespace vcsclient;


class VCSClientSVN extends VCSClientImpl implements VCSClient {

    public function __construct($path) {
        parent::__construct($path);
        $this->control = "svn";
    }

    /**
     * Обновляет репозиторий
     * @return bool
     */
    public function update() {
        $cmd = "svn up --non-interactive --no-auth-cache --force ". $this->path .  " 2>&1";
        return $this->exec($cmd);
    }

    public function commit($msg) {
        $cmd = "svn ci --non-interactive --no-auth-cache --force ". $this->path . " -m ". $msg . " 2>&1";
        return $this->exec($cmd);
    }
}