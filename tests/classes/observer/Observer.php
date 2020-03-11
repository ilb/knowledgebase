<?php

namespace observer;

interface Observer {
    public function execute($element, $textNotify);
}

