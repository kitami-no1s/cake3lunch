<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

class UsersController extends AppController {
	public function initialize() {
		parent::initialize ();

		$this->Auth->allow ( [ 
				'register',
				'logout'
		] );
	}
	public function isAuthorized($user = null) {
		$action = $this->request->params ['action'];
		if ($user ['role'] === 'admin') {
			return true;
		}
		if (in_array ( $action, [ 
				'add'
		] )) {
			return false;
		}
		return true;
	}
	public function register() {
		$user = $this->Users->newEntity ();
		if ($this->request->is ( 'post' )) {
			$user = $this->Users->patchEntity ( $user, $this->request->data );
			if ($user->role === "1") {
				$user->role = 'admin';
			}
			if ($this->Users->save ( $user )) {
				$this->Auth->setUser ( $user );

				return $this->redirect ( $this->Auth->redirectUrl () );
			}
			$this->Flash->error ( __ ( 'ユーザ登録に失敗しました' ) );
		}
		$this->set ( compact ( 'user' ) );
	}
	public function login() {
		$user = $this->Users->newEntity ();
		if ($this->request->is ( 'post' )) {
			$user = $this->Auth->identify ();
			if ($user) {
				$this->Auth->setUser ( $user );

				return $this->redirect ( $this->Auth->redirectUrl () );
			} else {
				$this->Flash->error ( __ ( 'error' ) );
			}
		}
		$this->set ( compact ( 'user' ) );
	}
	public function index() {
		$users = $this->paginate ( $this->Users );
		$this->set ( compact ( 'users' ) );
	}
	public function logout() {
		$this->Flash->success ( __ ( "ログアウトしました" ) );

		return $this->redirect ( $this->Auth->logout () );
	}
	public function edit() {
		$id = $this->Auth->user ( 'id' );
		$user = $this->Users->get ( $id );
		if ($this->request->is ( [ 
				'patch',
				'post',
				'put'
		] )) {
			$user = $this->Users->patchEntity ( $user, $this->request->data );
			if ($this->Users->save ( $user )) {
				$this->Auth->setUser ( $user );
				$this->Flash->success ( __ ( 'ユーザ情報を更新しました' ) );
				return $this->redirect ( [ 
						'action' => 'index'
				] );
			}
			$this->Flash->error ( __ ( 'ユーザ情報の更新に失敗しました' ) );
		}
		unset ( $user ["password"] );
		$this->set ( compact ( 'user' ) );
	}
	public function add() {
		$user = $this->Users->newEntity ();
		if ($this->request->is ( 'post' )) {
			$user = $this->Users->patchEntity ( $user, $this->request->data );
			if ($user->role === "1") {
				$user->role = 'admin';
			}
			if ($this->Users->save ( $user )) {

				return $this->redirect ( $this->Auth->redirectUrl () );
			}
			$this->Flash->error ( __ ( 'ユーザの作成に失敗しました' ) );
		}
		$this->set ( compact ( 'user' ) );
	}
}