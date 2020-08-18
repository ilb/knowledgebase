<?php


namespace response;


class Response {

    /**
     * @var class any
     */
    private $elements;

    /**
     * Response constructor.
     * @param $elem class any
     */
    function __construct($elem) {
        $this->elements = $elem;
    }

    /**
     * @param $elem class any
     */
    function setElement($elem) {
        $this->elements = $elem;
    }

    /**
     * @return class any
     */
    function getElements() {
        return $this->elements;
    }
}