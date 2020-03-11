<?php

namespace observer;

interface Observer {
    /**
     * @param \elements\Element $element
     * @param string $textNotify
     */
    public function execute($element, $textNotify);
}

