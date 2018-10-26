<?php
    namespace App\Controller;
    
    use App\Controller\AppController;
    use Cake\ORM\TableRegistry;
    use Cake\Datasource\ConnectionManager;
    
    class StoresController extends AppController
    {
        public function initialize()
        {
            parent::initialize();
            $this->Stations = TableRegistry::getTableLocator()->get('stations');
            $this->s_s = TableRegistry::getTableLocator()->get('stations_stores');
        }
        
        public function isAuthorized($user = null)
        {
            return true;
        }
        
        public function register()
        {
            
            //　プルダウン用
            $list = $this->Stations->find('list',[
                'keyField' => 'id',
                'valueField' => 'name',
            ]);
            $store = $this->Stores->newEntity();
            
            //　登録ボタン押下
            if ($this->request->is('post')) {
                $transaction = ConnectionManager::get('default');
                $transaction->begin();
                try{
                    $store = $this->Stores->patchEntity($store, $this->request->data);
                    if(!$this->Stores->save($store)){
                        $this->Flash->error(__('店舗テーブルのほうのエラー'));
                    }
             
                    $s_s = $this->s_s->create();
                    $s_s[store_id] = $store->id;
                    $s_s[station_id] = $this->request->getData('station_id');
                    dump($s_s);
                    $this->s_s->save($s_s);
                    $this->Flash->success(__('お店を登録しました'));
                    $transaction->commit();
                    $this->redirect(['Controller'=>'Stores','action'=>'index']);
                }catch(\Exception $e){
                    $this->Flash->error(__('お店の登録に失敗しました'));
                    $transaction->rollback();
                } 
            }
            $this->set(compact('store','list'));
        }
        
        public function index()
        {
            $stores = $this->paginate($this->Stores);
            $this->set(compact('stores'));
        }
    }