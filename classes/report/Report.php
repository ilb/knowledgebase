<?php

namespace report;

use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

abstract class Report {
    /**
     * @var \Symfony\Component\Serializer\Serializer
     */
    protected $serializer;
    
    /**
     * @var array \users\User
     */
    protected $users = array();   
    
    /**
     * Настройки для формирования xml
     * @var array
     */
    protected $context = [
        'xml_root_node_name' => 'ListResponse',
        'xml_format_output' => true,
    ];
    
    /**
     * Создает объект сериализатора Без него ничего не будет работать
     */
    public function createSerializer() {
        $encoders = [new XmlEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $this->serializer = new Serializer($normalizers, $encoders);
    }
    
    /**
     * @return array \user\User
     */
    public function getUsers() {
        return $this->users;
    }

    /**
     * @param array \user\User $users
     */
    public function setUsers($users) {
        $this->users = $users;
    }
    
}
