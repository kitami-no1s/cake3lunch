<?php
    namespace App\Controller;
    
    use App\Controller\AppController;
    
    class StationsController extends AppController
    {
        public $paginate = [
			'limit' => 5,
	];
        public function initialize()
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
        
        public function result($id)
        {
            $this->loadComponent('Paginator');
            try {
                $stores = $this->Paginator->paginate($this->Stations->Stores
                    ->find('all')
                    ->contain(['Stations','StationsStores'])
                    ->matching('Stations', function($q) use ($id) {
                        return $q->where(['Stations.id' => $id]);
                    }));
                $station = $this->Stations->get($id);
                $this->set(compact('stores', 'station'));
            } catch(\Exception $e) {
                $this->Flash->error(__('登録されていない駅が選択されました'));
                return $this->redirect(['controller'=>'Comments','action'=>'index']);
            }
        }
    }