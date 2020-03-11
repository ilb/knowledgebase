<?php

class WatcherSubscribtions {
    
    /**
     *
     * @var Notification
     */
    private $notification;
    
    /**
     * Создает экземпляр объекта Notification
     */
    public function setNotification() {
        $this->notification = new Notification();
    }
    
    /**
     * 
     * @param string $elemntDiv
     */
    public function notification($elemntDiv) {
        preg_match_all("/<div.*?>/", $elemntDiv, $out);
        $tag = $out[0][0];
        $idDoc = $this->getId($tag);
        $textNotificate = $this->getText(
                explode($tag, $elemntDiv)[1]);
        $this->notification->notify($idDoc, $textNotificate);
    }
    
    /**
     * Возвращает найденный Id в теге
     * @param string $tag
     * @return string
     */
    private function getId($tag) {
        /**
         * Example 
         * <div id="doc1">
         * return doc1
         */
        preg_match_all("/id=[^>]*/", $tag, $out);
        $id = explode("id=\"", $out[0][0])[1];
        $id = explode("\"", $id)[0];        
        return $id;
    }
    
    /**
     * Возвращает найденный текст между тегом
     * @param string $tag
     * @return string
     */
    private function getText($tag) {
        /**
         * Example
         * Text</div>
         * return Text
         */
        return explode("</div>", $tag)[0];
    }
}