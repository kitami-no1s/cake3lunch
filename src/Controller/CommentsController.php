<?php
    namespace App\Controller;
    
    use App\Controller\AppController;
    
    class CommentsController extends AppController
    {
        public function initialize()
        {
            parent::initialize();
            
        }
        
        public function isAuthorized($user = null)
        {
            return true;
        }
        
        public function add($store_id = null)
        {
            try{
                $store = $this->Comments->Stores->get($store_id);
            } catch (Exception $ex) {
                $this->Flash->error(__('error'));
                return $this->redirect(['controller'=>'Users','action'=>'index']);
            }
            $comment = $this->Comments->newEntity();
            if ($this->request->is('post')) {
                $comment = $this->Comments->patchEntity($comment, $this->request->data);
                $comment->store_id = $store_id;
                $comment->user_id = $this->Auth->user('id');
                if ($this->Comments->save($comment)) {
                    $this->Flash->success(__('コメントを投稿しました'));
                    
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('コメントの投稿に失敗しました'));
            }
            $this->set(compact('comment'));
        }
        
        public function index()
        {
            
            $this->paginate =[
                'contain' => ['Users','Stores','Images'],
                'order' => ['created' => 'desc']
            ];
            $this->set('comments', $this->paginate($this->Comments));
        }
        
        public function detail($comment_id)
        {
            try{
             $comment = $this->Comments->get($comment_id, [
                 'contain' => ['Users', 'Stores']
             ]);
            } catch (Exception $ex) {
                $this->Flash->error(__('コメントの表示に失敗しました'));
                return $this->redirect(['controller'=>'comments','action'=>'index']);
            }
            
            $images = $this->Comments->Images
                ->find()
                ->where(['comment_id' => $comment->id]);
            
            $this->set(compact('comment','images'));
        }
    }