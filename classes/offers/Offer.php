<?php

namespace offers;

class Offer {

    /**
     *  Кто меняет
     * @var \user\User
     */
    private $user;

    /**
     * Ссылка на источник
     * @var string
     */
    private $link;

    /**
     * Изменения
     * @var string
     */
    private $changes;

    /**
     *  Опубликована или нет
     * @var boolean
     */
    private $published;
    
    /**
     * @var \observer\OfferObserver
     */
    private $observer;
    
    /**
     * @param \elements\Element $element
     * @param \user\User $user
     */
    public function __construct($link, $user) {
        $this->link = $link;
        $this->user = $user;
    }
    
    /**
     * @return \user\User
     */
    public function getUser() {
        return $this->user;
    }

    /**
     * @return string
     */
    public function getLink() {
        return $this->link;
    }

    /**
     * @return string
     */
    public function getChanges() {
        return $this->changes;
    }

    /**
     * @return boolean
     */
    public function getPublished() {
        return $this->published;
    }

    /**
     * @param string $changes
     */
    public function setChanges($changes) {
        $this->changes = $changes;
    }

    /**
     * Опубликована или нет
     * @param boolean $published
     */
    public function setPublished($published) {
        $this->published = $published;
        $this->observer->execute($this->user, "Вашу публикацию одобрили", "Опубликовано");
    }

    /**
     * устанавливает наблюдателя
     * @param \observer\OfferObserver $observer
     */
    public function setObserver(\observer\OfferObserver $observer) {
        $this->observer = $observer;
    }

}
