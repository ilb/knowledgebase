<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace requests;

/**
 * Класс для работы с запросами curl
 *
 * @author gudov
 */
class Curl {
    
    /**
     *  Хранит возвращаемое значение curl_init()
     * @var cURLHandler
     */
    private $ch;
    
    /**
     * Данные для запроса (используется в POST или PUT запросах)
     * @var array
     */
    private $data = array();
    
    /**
     * Конструктор
     * @param string $url
     */
    public function __construct($url) {
        $this->ch = curl_init($url);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
    }
    
    /**
     *  При удалении класса закрывает курл
     */
    public function __destruct() {
        $this->close();
    }
    
    /**
     * Новое значение url
     * @param string $url
     */
    public function setURL($url) {
        curl_setopt($this->ch, CURLOPT_URL, $url);
    }
    
    /**
     * Возвращает URL курла
     * @return string
     */
    public function getURL() {
        return curl_getinfo($this->ch, CURLOPT_URL);
    }
    
    /**
     * 
     * @param array $data
     * @throws Exception
     */
    public function setData($data) {
        if (gettype($data) != "array") {
            throw new Exception("Невозможно установать значение " . print_r($data, true));
        }
        $this->data = $data;
    }
    
    /**
     * Делает GET запрос и возвращает массив из JSON
     * @return array
     */
    public function getWithJSON() {
        return json_decode(curl_exec($this->ch), true);
    }
    
    /**
     * Просто делает GET и возвращает ответ
     * @return type
     */
    public function get() {
        return curl_exec($this->ch);
    }
    
   /**
    * TODO: 
    */
    public function POST() {
        if (!empty($this->data)) {
            $this->setDataCurl();
        }
    }
    
    /**
     * Закрывает соединение с курлом
     */
    public function close() {
        curl_close($this->ch);
    }
}
