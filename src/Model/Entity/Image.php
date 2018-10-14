<?php
    namespace App\Model\Entity;
    
    use Cake\ORM\Entity;
    
    class Image extends Entity
    {
        protected $_accesible = [
            '*' => true,
            'id'=> false,
        ];
    }