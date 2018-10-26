<?php
    namespace App\Model\Table;
    
    use Cake\ORM\Query;
    use Cake\ORM\RulesChecker;
    use Cake\ORM\Table;
    use Cake\Validation\Validator;
    
    class CommentsTable extends Table
    {
        public function initialize(array $config)
        {
            parent::initialize($config);
            $this->setTable('comments');
            $this->setPrimaryKey('id');
            $this->addBehavior('Timestamp');
            
            $this->belongsTo('Users');
            $this->hasMany('Images');
            $this->belongsTo('Stores');
        }
        
        public function validationDefault(Validator $validator)
        {
            $validator
                    ->integer('id')
                    ->allowEmpty('id', 'create');
            $validator
                    ->integer('store_id', 'create')
                    ->notEmpty('store_id');
            $validator
                    ->integer('user_id')
                    ->notEmpty('user_id');

            return $validator;
        }
    }