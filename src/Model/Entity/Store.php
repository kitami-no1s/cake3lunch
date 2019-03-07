<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Store extends Entity {
	protected $_accesible = [ 
			'*' => true,
			'id' => false
	];
}