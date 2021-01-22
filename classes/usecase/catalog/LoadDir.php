<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace usecase\catalog;

use parser\DocumentParser;
use usecase\helper\UseCase;

/**
 * Description of LoadDir
 *
 * @author gudov
 */
class LoadDir extends UseCase {

    private $dir;
    private $path;

    public function __construct($dir, $path) {
        if ($dir) {
            $path .= "/" . $dir;
        }
        $this->dir = $dir;
        $this->path = $path;
    }

    public function execute() {
        $docs = new DocumentParser();
        $docs = $docs->getDirandDocs($this->path);
        if ($this->dir) {
            for ($i = 0; $i < count($docs); $i++) {
                if (!$docs[$i]["dir"]) {
                    $docCOntext = file_get_contents($this->path . "/" . $docs[$i]["name"]);
                    $out = [];
                    preg_match_all("/<title>(.*)<\/title>/", $docCOntext, $out);
                    $docs[$i]["title"] = isset($out[1][0]) ? $out[1][0] : "";
                }
                $docs[$i]['parent'] = $this->dir;
            }
        }

        $prev = explode("/", $this->dir);
        if (count($prev) == 1) {
            $prev = "";
        } else {
            $prev = implode("/", array_slice($prev, 0, count($prev) - 1));
        }
//        $docs["parentDir"] = $prev;
        return array( "content"=>$docs, "parentDir" => $prev);
    }

}
