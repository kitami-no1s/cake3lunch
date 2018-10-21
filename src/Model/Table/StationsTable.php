<?php
    namespace App\Model\Table;
    
    use Cake\ORM\Query;
    use Cake\ORM\RulesChecker;
    use Cake\ORM\Table;
    use Cake\Validation\Validator;
    
    class StationsTable extends Table
    {
        public function initialize(array $config)
        {
            parent::initialize($config);
            $this->table('stations');
            $this->displayField('name');
            $this->primaryKey('id');
            
            $this->hasMany('stations_stores');
        }
        
        public function validationDefault(Validator $validator)
        {
            $validator
                    ->integer('id')
                    ->allowEmpty('id', 'create');
            $validator
                    ->requirePresence('name', 'create')
                    ->notEmpty('name')
                    ->add('name', 'unique', [
                        'rule' => 'validateUnique',
                        'provider' => 'table',
                        'message' => '登録できません'
                    ]);

            return $validator;
        }
        
        public function buildRules(RulesChecker $rules)
        {
            $rules->add($rules->isUnique(['name'], ['message' => '登録できません']));
            return $rules;
        }
    }