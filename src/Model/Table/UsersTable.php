<?php
    namespace App\Model\Table;
    
    use Cake\ORM\Query;
    use Cake\ORM\RulesChecker;
    use Cake\ORM\Table;
    use Cake\Validation\Validator;
    
    class UsersTable extends Table
    {
        public function initialize(array $config)
        {
            parent::initialize($config);
            $this->table('users');
            $this->displayField('name');
            $this->primaryKey('id');
            
            $this->hasMany('stations_users');
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
            $validator
                    ->requirePresence('password', 'create')
                    ->notEmpty('password');
            return $validator;
        }
    }