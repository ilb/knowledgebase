<?php

namespace subscription;


class Subscriptions {
    /**
     *
     * @var array \subscription\Subscription
     */
    private $subscribtions= array();
    
    /**
     * Находит все подписки содержащие в себе измененный документ
     * @param type $changeElement
     * @return array \subscription\Subscription
     */
    public function foundSubscription($changeElement) {
        $foundSubscription = array();        
        foreach ($this->subscribtions as $element) {
            if (!$this->isClass($element->getElement(), $changeElement)) {
                continue;
            }
            if ($element->getElement()->getUnicalName() == $changeElement->getUnicalName()) {
                $foundSubscription[] = $element;
            }
        }
        return $foundSubscription;
    }
    
    /**
     * проверяет что объект 1 и объект 2 созданы от одного класса
     * @param \elements\Element $obj1
     * @param \elements\Element $obj2
     * @return boolean
     */
    private function isClass($obj1, $obj2) {
        return get_class($obj1) == get_class($obj2);
    }
    
}
