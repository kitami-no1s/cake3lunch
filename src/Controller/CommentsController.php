<?php
    namespace App\Controller;
    
    use App\Controller\AppController;
    
    class CommentsController extends AppController
    {
        public function initializa()
        {
            parent::initialize();
            
        }
        
        public function isAuthorized($user = null)
        {
            return true;
        }
        
        public function add()
        {
            $station = $this->Comments->newEntity();
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
    }