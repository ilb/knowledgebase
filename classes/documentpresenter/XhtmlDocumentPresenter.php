<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace documentpresenter;

use repository\Repository;
use serialize\Serialize;
use usecase\subscriptions\GetSubscriptionDocUser;
use vcsclient\VCSClientFactory;

/**
 * Description of XhtmlDocumentPresenter
 *
 * @author gudov
 */
class XhtmlDocumentPresenter implements DocumentPresenter {

    /**
     * 
     * @param string $path
     */
    public function present($path) {
        $docContext = file_get_contents($path);
        $repo = new Repository(Config::getInstance()->connection);
        $subs = new GetSubscriptionDocUser(Config::getInstance()->login, $doc);
        $subs->setRepository($repo);
        $subs = $subs->execute();
        $ser = new Serialize();

        $subs = explode("<?xml version=\"1.0\"?>", $ser->arrToXML($subs))[1];

        if (!strpos($docContext, "oooxhtml.xsl")) {
            $head = "<?xml-stylesheet type=\"text/xsl\" href=\"/oooxhtml/oooxhtml.xsl\"?>";
            // убрать стили
            $docContext = str_replace("<link rel=\"stylesheet\" type=\"text/css\" href=\"/oooxhtml/oooxhtml.css\"/>", "", $docContext);
            // убрать скрипты
            $docContext = str_replace("<script type=\"text/javascript\" src=\"/privilegedAPI/web/scripts/privilegedAPI.js\"></script>
        <script type=\"text/javascript\" src=\"/oooxhtml/oooxhtml.js\"></script>", "", $docContext);
            // подключить свои стили
            $d = strpos($docContext, "<html");
            $docContext = substr($docContext, 0, $d) . $head . substr($docContext, $d);
        }

        $repoDocs = explode("/", $doc);
        $vcsFactory = new VCSClientFactory(Config::getInstance()->filespath);
        $vcsClient = $vcsFactory->getVCSClient($repoDocs[0]);
        $editURL = $vcsClient->info(implode("/", array_slice($repoDocs, 1)));
        $editURL = str_replace($_SERVER['ru.bystrobank.apps.svn.ws'], $_SERVER['ru.bystrobank.apps.svn.ws2'], $editURL);

//$docContext = str_replace("href=\"/oooxhtml/", "href=\"oooxhtml/", $docContext);
        $d = strpos($docContext, "</body>");
        $dir = explode("/", $allName);
        $dir = array_slice($dir, 0, count($dir) - 1);
        $dir = implode("/", $dir);
        $dop = "<file style='display: none'>$allName</file>" .
                "<mainDir style='display: none'>$dir</mainDir>" .
                "<document style='display: none'>$doc</document>" .
                "<user style='display: none'>$login</user>" .
                "<editURL style='display:none'>" . $editURL[0] . "</editURL>"
                . $subs;

        $docContext = substr($docContext, 0, $d) . $dop . substr($docContext, $d);
        return $docContext;
    }
    
}