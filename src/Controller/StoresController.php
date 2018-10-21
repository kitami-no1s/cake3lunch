<?php
    namespace App\Controller;
    
    use App\Controller\AppController;
    
    class StoresController extends AppController
    {
        public function initialize()
        {
            parent::initialize();
            
        }
        
        public function isAuthorized($user = null)
        {
            return true;
        }
        
        public function register()
        {
            $store = $this->Stores->newEntity();
            if ($this->request->is('post')) {
                $store = $this->Stores->patchEntity($store, $this->request->data);
                if ($this->Stores->save($store)) {
                    $this->Flash->success(__('駅を登録しました'));
                    
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('駅の登録に失敗しました'));
            }
            $this->set(compact('store'));
        }
        
        public function index()
        {
            $stores = $this->paginate($this->Stores);
            $this->set(compact('stores'));
        }
    }