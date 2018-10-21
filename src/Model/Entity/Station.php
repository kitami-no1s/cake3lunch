<?php
    namespace App\Model\Entity;
    
    use Cake\ORM\Entity;
    
    class Station extends Entity
    {
        protected $_accesible = [
            '*' => true,
            'id'=> false,
        ];
    }