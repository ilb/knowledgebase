<?php

namespace observer;

interface Observer {
    /**
     * @param string $element
     * @param string $diff
     * @param string $event 
     */
    public function execute($element, $diff, $event);
}

