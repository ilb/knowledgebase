<?php


namespace vcsclient;


use config\Config;

class VCSClientFactory {

    /**
     * @const array
     */
    const dirs = [ ".git", ".svn" ];

    /**
     * @var string
     */
    private $repo;

    /**
     * VCSClientFactory constructor.
     * @param $repo
     */
    public function __construct($repo){
        $this->repo = $repo;
    }

    /**
     * Возвращает имя контроля версии или null в случае его отсутвия
     * @return string|null
     */
    public function check() {
        $files = scandir(Config::getInstance()->filespath . "/" . $this->repo);
        foreach (self::dirs as $dir) {
            if (in_array($dir, $files)) {
                return substr($dir, 1);
            }
        }
        return NULL;
    }

    /**
     * Из ходя из версии отдает объект класса или null в случае отсутвия контроля версий
     * @return VCSClientSVN|null
     */
    public function getVCSClient() {
        switch ($this->check()) {
            case "svn":
                return new VCSClientSVN(Config::getInstance()->filespath . "/" . $this->repo);
            default:
                throw new \Exception(Config::getInstance()->filespath . "/" . $this->repo . " not supported");
        }
    }
}