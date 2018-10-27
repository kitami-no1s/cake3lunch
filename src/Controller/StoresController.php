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
            $this->StationsStores = TableRegistry::getTableLocator()->get('stations_stores');
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

            //　登録ボタン押下
            if ($this->request->is('post')) {
                $transaction = ConnectionManager::get('default');
                //　トランザクション開始
                $transaction->begin();
                try{
                    $store = $this->Stores->newEntity([
                            'name' => $this->request->getData('name'),
                            'address'=> $this->request->getData('address')
                    ]);
                    //　店舗先に登録
                    $store = $this->Stores->save($store);
                    //　今登録したしたID取得
                    $store_id = $store->id;
                    
                    
                    $StationsStores = $this->StationsStores->newEntity([
                            'station_id' => $this->request->getData('station_id'),
                            'store_id' => $store_id
                    ]);
                    
                    $this->StationsStores->save($StationsStores);
                    //　トランザクションコミット
                    $transaction->commit();
                    $this->Flash->success(__('お店を登録しました'));
                    $this->redirect(['Controller'=>'Stores','action'=>'index']);
                }catch(\Exception $e){
                    $this->Flash->error(__('お店の登録に失敗しました'));
                    // SQLなかったことにする
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