<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use Cake\Event\Event;
use App\Form\StoresForm;

class StoresController extends AppController {
	public $paginate = [
			'contain' => 'stations',
			'limit' => 5
	];
	public function initialize() {
		parent::initialize ();
		// $this->loadComponent('Csrf');
	}
	public function isAuthorized($user = null) {
		return true;
	}
	public function search() {
		$this->autoRender = false;
		if ($this->request->is ( 'ajax' )) {
			// ajaxで送られてきた駅名をもとに検索、
			$word = $this->request->getData ( 'word' );
			$stations = TableRegistry::getTableLocator ()->get ( 'stations' );
			$list = $stations->find ()->select ( [
					'name'
			] )->where ( [
					'name LIKE' => '%' . $word . '%'
			] )->toArray ();

			$data = "";
			if (!empty ( $list )) {
				foreach ( $list as $val ) {
					$data .= "<div>" . $val ['name'] . "</div>";
				}
				echo json_encode ( $data );
			}
		}
	}
	public function gojyuon() {
		$this->autoRender = false;
		if ($this->request->is ( 'ajax' )) {
			// ajaxで送られてきた五十音をもとに検索、
			$word = $this->request->getData ( 'word' );
			$stations = TableRegistry::getTableLocator ()->get ( 'stations' );
			$list = $stations->find ()->select ( [
					'name'
			] )->where ( [
					'initial' => strval ( $word )
			] )->toArray ();

			$data = "";
			foreach ( $list as $val ) {
				$data .= "<div>" . $val ['name'] . "</div>";
			}
			echo json_encode ( $data );
		}
	}
	public function register() {
		// 登録ボタン押下
		if ($this->request->is ( 'post' )) {
			$form = new StoresForm ();
			if ($form->execute ( $this->request->getData () )) {
				$this->Flash->success ( __ ( 'お店を登録しました' ) );
				$this->redirect ( [
						'controller' => 'stores',
						'action' => 'index'
				] );
			} else {
				$this->Flash->error ( __ ( 'お店の登録に失敗しました' ) );
			}
		}
	}
	public function index() {
		$stores = $this->paginate ( $this->Stores );
		$cnt = count($stores);

		$this->set ( compact ( 'stores','cnt' ) );
	}

        public function comments($id)
        {
            $user = $this->Auth->user('id');
            try {
                $this->loadComponent('Paginator');
                $comments = $this->Paginator->paginate($this->Stores->Comments
                    ->find('all')
                    ->contain(['Stores', 'Users', 'Images'])
                    ->matching('Stores', function($q) use ($id) {
                        return $q->where(['Stores.id' => $id]);
                }));
                $store = $this->Stores->get($id);
                $this->set(compact('comments', 'store', 'user'));
            } catch (\Exception $e) {
                $this->Flash->error(__('登録されていない駅が選択されました'));
                return $this->redirect(['controller'=>'Comments','action'=>'index']);
            }
        }
}