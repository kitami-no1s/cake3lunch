<?php
    namespace App\Controller;
    
    use App\Controller\AppController;
    use Cake\ORM\TableRegistry;
    use Cake\Datasource\ConnectionManager;
    use Cake\Event\Event;
    
    class StoresController extends AppController
    {
        public $paginate = ['contain'=>'stations'];
        
        public function initialize()
        {
            parent::initialize();
            //$this->loadComponent('Csrf');
            $this->Stations = TableRegistry::getTableLocator()->get('stations');
            $this->StationsStores = TableRegistry::getTableLocator()->get('stations_stores');
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
            $list = '';
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
                    //　店舗を先に登録
                    $store = $this->Stores->save($store);
                    //　今登録したしたID取得
                    $store_id = $store->id;
                    $name = $this->request->getData('station_name');
                    
                    $sub = $this->Stations->find()->select(['id'])
                            ->where([
                                'name' => $name
                            ])
                            ->first();
                                       
                    $this->StationsStores->query()->insert(['station_id','store_id'])
                            ->values([
                                'station_id' =>$sub['id'],
                                'store_id' => $store_id
                            ])
                            ->execute();
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