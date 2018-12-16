<?php
    namespace App\Controller;
    
    use App\Controller\AppController;
    
    class StationsController extends AppController
    {
        public function initializa()
        {
            parent::initialize();
            
        }
        
        public function isAuthorized($user = null)
        {
            $action = $this->request->params['action'];
            if ($user['role'] === 'admin'){
                return true;
            }
            if (in_array($action, ['register'])) {
                return false;
            }
            return true;
        }
        
        public function register()
        {
            $station = $this->Stations->newEntity();
            if ($this->request->is('post')) {
                $station = $this->Stations->patchEntity($station, $this->request->data);
                if ($this->Stations->save($station)) {
                    $this->Flash->success(__('駅を登録しました'));
                    
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('駅の登録に失敗しました'));
            }
            $this->set(compact('station'));
        }
        
        public function index()
        {
            $stations = $this->paginate($this->Stations);
            $this->set(compact('stations'));
        }
        
        public function result()
        {
            
            $this->paginate =[
                'contain' => ['Images'],
                'order' => ['created' => 'desc']
            ];
            $this->set('comments', $this->paginate($this->Comments));
        }
    }

