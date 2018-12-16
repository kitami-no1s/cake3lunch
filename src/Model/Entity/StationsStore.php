<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class StationsStore extends Entity {
	protected $_accesible = [ 
			'*' => true,
			'id' => false
	];
}