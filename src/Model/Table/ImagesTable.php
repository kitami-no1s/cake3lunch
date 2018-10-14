<?php
    namespace App\Model\Table;
    
    use Cake\ORM\Query;
    use Cake\ORM\RulesChecker;
    use Cake\ORM\Table;
    use Cake\Validation\Validator;
    
    class ImagesTable extends Table
    {
        public function initialize(array $config)
        {
            parent::initialize($config);
            $this->table('images');
            $this->primaryKey('id');
            
            $this->belongsTo('Comments');
        }
        
        public function validationDefault(Validator $validator)
        {
            $validator
                    ->integer('id')
                    ->allowEmpty('id', 'create');
            $validator
                    ->integer('comment_id', 'create')
                    ->notEmpty('comment_id');

            return $validator;
        }
    }