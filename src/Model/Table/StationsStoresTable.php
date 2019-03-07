<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class StationsStoresTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->setTable('stations_stores');
        $this->setPrimaryKey('id');
        
        $this->belongsTo('stations');
    }
    
}