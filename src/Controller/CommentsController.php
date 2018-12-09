<?php

namespace App\Controller;

use App\Controller\AppController;

class CommentsController extends AppController {
	public function initializa() {
		parent::initialize ();
	}
	public function isAuthorized($user = null) {
		return true;
	}
	public function add($store_id = null) {
		try {
			$store = $this->Comments->Stores->get ( $store_id );
		} catch ( Exception $ex ) {
			$this->Flash->error ( __ ( 'error' ) );
			return $this->redirect ( [ 
					'controller' => 'Users',
					'action' => 'index'
			] );
		}
		$comment = $this->Comments->newEntity ();
		if ($this->request->is ( 'post' )) {
			$comment = $this->Comments->patchEntity ( $comment, $this->request->data );
			$comment->store_id = $store_id;
			$comment->user_id = $this->Auth->user ( 'id' );
			if ($this->Comments->save ( $comment )) {
				$this->Flash->success ( __ ( 'コメントを投稿しました' ) );

				return $this->redirect ( [ 
						'action' => 'index'
				] );
			}
			$this->Flash->error ( __ ( 'コメントの投稿に失敗しました' ) );
		}
		$this->set ( compact ( 'comment' ) );
	}
	public function index() {
		$comments = $this->paginate ( $this->Comments );
		$this->set ( compact ( 'comments' ) );
	}
}