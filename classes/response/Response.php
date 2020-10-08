<?php


namespace response;


class Response {

    /**
     * @var mixed
     */
    private $elements;

    /**
     * Response constructor.
     * @param $elem mixed
     */
    function __construct($elem) {
        $this->elements = $elem;
    }

    /**
     * @param $elem mixed
     */
    function setElement($elem) {
        $this->elements = $elem;
    }

    /**
     * @return mixed
     */
    function getElements() {
        return $this->elements;
    }
}