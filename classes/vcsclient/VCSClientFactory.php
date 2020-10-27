<?php

namespace vcsclient;

class VCSClientFactory {

    /**
     * @const array
     */
    const dirs = [ ".git", ".svn" ];

    /**
     * @var string
     */
    private $path;

    /**
     * VCSClientFactory constructor.
     * @param $path
     */
    public function __construct($path){
        $this->path = $path;
    }

    /**
     * Возвращает имя контроля версии или null в случае его отсутвия
     * @param $repo
     * @return string|null
     */
    public function check($repo) {
        $files = scandir($this->path . "/" . $repo);
        foreach (self::dirs as $dir) {
            if (in_array($dir, $files)) {
                return substr($dir, 1);
            }
        }
        return NULL;
    }

    /**
     * Из ходя из версии отдает объект класса или null в случае отсутвия контроля версий
     * @param $repo
     * @return VCSClientSVN|null
     * @throws \Exception
     */
    public function getVCSClient($repo) {
        switch ($this->check($repo)) {
            case "svn":
                return new VCSClientSVN($this->path . "/" . $repo);
            default:
                throw new \Exception($this->path. "/" . $repo . " not supported");
        }
    }
}