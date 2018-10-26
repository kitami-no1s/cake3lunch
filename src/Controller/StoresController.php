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
            
            $store = $this->s_s->newEntity();
            //　登録ボタン押下
            if ($this->request->is('post')) {
                $transaction = ConnectionManager::get('default');
                $transaction->begin();
                try{
                    $store = $this->Stores->newEntity([
                            'name' => $this->request->getData('name'),
                            'address'=> $this->request->getData('address')
                    ]);
                    $store = $this->Stores->save($store);
                    $store_id = $store->id;
                    
                    $s_s = $this->s_s->newEntity([
                            'station_id' => $this->request->getData('station_id'),
                            'store_id' => $store_id
                    ]);
                    
                    $this->s_s->save($s_s);
                    $transaction->commit();
                    $this->Flash->success(__('お店を登録しました'));
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