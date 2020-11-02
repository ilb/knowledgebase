<?php


namespace vcsclient;


class VCSClientImpl {

    /**
     * path to repo
     * @var string
     */
    protected $path;

    public function __construct($path) {
        $this->path = $path;
    }

    protected function exec($cmd) {
        $res = NULL;
        $out = NULL;
        exec($cmd, $out, $res);
        if ($res) {
            trigger_error($cmd. " failed:" . join(PHP_EOL, $out));
        }
        return $out;
    }

}