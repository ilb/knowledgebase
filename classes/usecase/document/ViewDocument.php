<?php
namespace usecase\document;

use usecase\helper\UseCase;

class ViewDocument extends UseCase {

    /**
     * @var string
     */
    private $document;

    /**
     * @var string
     */
    private $path;

    /**
     * ViewDocument constructor.
     * @param string $document
     * @param string $path
     */
    public function __construct($document, $path) {
        $this->document = $document;
        $this->path = $path;
    }

    /**
     * Path to file
     * @return string
     */
    public function execute() {
        return $this->scan($this->path);
    }

    private function scan($dir) {
        $path = null;
        $files = scandir($dir);
        foreach ($files as $file) {
            if (is_dir($dir . "/" . $file) && $file != "." && $file != ".." && $file != "oooxhtml") {
                $path = $this->scan($dir . "/" . $file);
            }
            if (is_file($dir . "/" . $file) && $file == $this->document) {
                $path = $dir . "/" . $file;
            }

            if ($path != null) {
                return $path;
            }
        }
        return $path;
    }
}