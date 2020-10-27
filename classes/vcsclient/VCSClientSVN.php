<?php


namespace vcsclient;


class VCSClientSVN extends VCSClientImpl implements VCSClient {

    public function __construct($path) {
        parent::__construct($path);
    }

    /**
     * Обновляет репозиторий
     * @return bool
     */
    public function update() {
        $cmd = "svn up --non-interactive --no-auth-cache --force ". $this->path .  " 2>&1";
        return $this->exec($cmd);
    }

    /**
     * @param string $msg
     * @return bool|mixed
     */
    public function commit($msg) {
        $cmd = "svn ci --non-interactive --no-auth-cache ". $this->path . " -m \"". $msg . "\" 2>&1";
        return $this->exec($cmd);
    }

    /**
     * @param $file
     * @return bool|mixed
     */
    public function add($file) {
        $cmd = "svn add --non-interactive --no-auth-cache ". $this->path . "/$file 2>&1";
        return $this->exec($cmd);
    }
}
