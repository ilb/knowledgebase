<?php

namespace offers;

class Offer {

    /**
     *
     * @var \user\User
     */
    private $user;

    /**
     *
     * @var \elements\Element
     */
    private $element;

    /**
     *
     * @var boolean
     */
    private $approved;

    /**
     *
     * @var string
     */
    private $content;

    /**
     * 
     * @param \elements\Element $element
     * @param \user\User $user
     */
    public function __construct($element, $user, $content) {
        $this->element = $element;
        $this->user = $user;
        $this->content = $content;
    }

    /**
     * 
     * @param boolean $approved
     */
    public function setApprover($approved) {
        $this->approved = $approved;
    }

    /**
     * 
     * @return \user\User()
     */
    public function getUser() {
        return $this->user;
    }

}
