<?php
namespace notify;

interface Notify {
    public function notify();
    public function changeContent();
    public function setObserver($observer);
    public function deleteObserver();
}