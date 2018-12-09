<?php
    namespace App\Controller;
    
    use App\Controller\AppController;
    use Cake\ORM\TableRegistry;
    use Cake\Datasource\ConnectionManager;
    use Cake\Event\Event;
    use App\Form\StoresForm;
    
    class StoresController extends AppController
    {
        public $paginate = ['contain'=>'stations'];
        
        public function initialize()
        {
            parent::initialize();
            //$this->loadComponent('Csrf');
        }
        
        public function isAuthorized($user = null)
        {
            return true;
        }
        
        public function gojyuon(){
            $this->autoRender = false;           
            if($this->request->is('ajax')){
                //ajaxで送られてきた五十音をもとに検索、
                $word  = $this->request->getData('word');
                $stations = TableRegistry::getTableLocator()->get('stations');
                $list = $stations->find()->select(['name'])
                    ->where(['initial'=>strval($word)])
                    ->toArray();
                
               $data = "";
                foreach($list as $val){
                    $data.= "<div>".$val['name']."</div>";       
                }
                echo json_encode($data);
            }
        }
        
        public function register()
        {   
            //　登録ボタン押下
            if ($this->request->is('post')) {
                $form = new StoresForm();
                if($form->execute($this->request->getData())){
                    $this->redirect(['controller'=>'stores','action'=>'index']);
                }      
            }
        }
        
        public function index()
        {
          
            $stores = $this->paginate($this->Stores);
            
            $this->set(compact('stores'));
        }
    }