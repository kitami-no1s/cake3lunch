<?php
    namespace App\Model\Table;
    
    use Cake\ORM\Query;
    use Cake\ORM\RulesChecker;
    use Cake\ORM\Table;
    use Cake\Validation\Validator;
    
    class StoresTable extends Table
    {
        public function initialize(array $config)
        {
            parent::initialize($config);
            $this->table('stores');
            $this->displayField('name');
            $this->primaryKey('id');
            
            $this->hasMany('Comments');
            $this->hasMany('stations_stores');
        }
        
        public function validationDefault(Validator $validator)
        {
            $validator
                    ->integer('id')
                    ->allowEmpty('id', 'create');
            $validator
                    ->requirePresence('name', 'create')
                    ->notEmpty('name');

            return $validator;
        }
    }