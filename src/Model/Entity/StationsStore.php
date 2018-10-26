<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class StationStore extends Entity
{
    protected $_accesible = [
        '*' => true,
        'station_id'=> true,
    ];
}