<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use RuntimeException;

class CommentsController extends AppController {
	public function initialize() {
		parent::initialize ();
	}
	public function isAuthorized($user = null) {
		return true;
	}
	public function add($store_id = null) {
		try {
			$store = $this->Comments->Stores->get ( $store_id );
		} catch ( \Exception $ex ) {
			$this->Flash->error ( __ ( 'error' ) );
			return $this->redirect ( [
					'controller' => 'Users',
					'action' => 'index'
			] );
		}
		$this->Images = TableRegistry::getTableLocator ()->get ( 'images' );

		$comment = $this->Comments->newEntity ();

		try {
			if ($this->request->is ( 'post' )) {

				$success = false;
				$transaction = ConnectionManager::get ( 'default' );
				$transaction->begin ();
				$comment = $this->Comments->patchEntity ( $comment, $this->request->getData () );
				$comment->store_id = $store_id;
				$comment->user_id = $this->Auth->user ( 'id' );
				if ($this->Comments->save ( $comment )) {
					$success = true;
				}

				if ($success === true && $this->request->getData ( 'file_name' ) !== "") {
					$dir = realpath ( WWW_ROOT . "/img" );
					$limitFileSize = 1024 * 1024;
					$temp ['file'] = "";
					$temp ['file'] = $this->file_upload ( $this->request->data['file_name'], $dir, $limitFileSize );
					$this->Images->query ()->insert ( [
							'image_url',
							'comment_id'
					] )->values ( [
							'image_url' => $temp ['file'],
							'comment_id' => $comment->id
					] )->execute ();
				}
				if ($success === true) {
					$transaction->commit ();
					$this->Flash->success ( __ ( 'コメントを投稿しました' ) );
					return $this->redirect ( [
							'controller' => 'Comments',
							'action' => 'index'
					] );
				}
				$transaction->rollback ();
				$this->Flash->error ( __ ( 'コメントの投稿に失敗しました' ) );
			}
			$this->set ( compact ( 'comment' ) );
		} catch ( \Exception $e ) {
			$transaction->rollback ();
			$this->Flash->error ( __ ( 'error' ) );
			return $this->redirect ( [
					'controller' => 'Users',
					'action' => 'index'
			] );
		}
	}
	public function index($user_id = "") {
		if (empty ( $user_id )) {
			$this->paginate = [
					'contain' => [
							'Users',
							'Stores',
							'Images'
					],
					'order' => [
							'created' => 'desc'
					]
			];
		} else {
			$this->paginate = [
					'contain' => [
							'Users',
							'Stores',
							'Images'
					],
					'conditions' => [
							'user_id' => $user_id
					],
					'order' => [
							'created' => 'desc'
					]
			];
		}
		$this->set ( 'comments', $this->paginate ( $this->Comments ) );
	}
	public function detail($comment_id) {
		try {
			$comment = $this->Comments->get ( $comment_id, [
					'contain' => [
							'Users',
							'Stores'
					]
			] );
		} catch ( \Exception $ex ) {
			$this->Flash->error ( __ ( 'コメントの表示に失敗しました' ) );
			return $this->redirect ( [
					'controller' => 'comments',
					'action' => 'index'
			] );
		}

		$images = $this->Comments->Images->find ()->where ( [
				'comment_id' => $comment->id
		] );

		$this->set ( compact ( 'comment', 'images' ) );
	}

	private function file_upload ($file = null,$dir = null, $limitFileSize = 1024 * 1024){
		try {
			// ファイルを保存するフォルダ $dirの値のチェック
			if ($dir){
				if(!file_exists($dir)){
					throw new RuntimeException('指定のディレクトリがありません。');
				}
			} else {
				throw new RuntimeException('ディレクトリの指定がありません。');
			}

			// 未定義、複数ファイル、破損攻撃のいずれかの場合は無効処理
			if (!isset($file['error']) || is_array($file['error'])){
				throw new RuntimeException('Invalid parameters.');
			}

			switch ($file['error']) {
				case 0:
					break;
				case UPLOAD_ERR_OK:
					break;
				case UPLOAD_ERR_NO_FILE:
					throw new RuntimeException('No file sent.');
				case UPLOAD_ERR_INI_SIZE:
				case UPLOAD_ERR_FORM_SIZE:
					throw new RuntimeException('Exceeded filesize limit.');
				default:
					throw new RuntimeException('Unknown errors.');
			}

			// ファイル情報取得
			$fileInfo = new File($file["tmp_name"]);

			// ファイルサイズのチェック
			if ($fileInfo->size() > $limitFileSize) {
				throw new RuntimeException('Exceeded filesize limit.');
			}

			// ファイルタイプのチェックし、拡張子を取得
			if (false === $ext = array_search($fileInfo->mime(),
					['jpg' => 'image/jpeg',
							'png' => 'image/png',
							'gif' => 'image/gif',],
					true)){
						throw new RuntimeException('Invalid file format.');
					}

					// ファイル名の生成
					//            $uploadFile = $file["name"] . "." . $ext;
					$uploadFile = sha1_file($file["tmp_name"]) . "." . $ext;

					// ファイルの移動
					if (!@move_uploaded_file($file["tmp_name"], $dir . "/" . $uploadFile)){
						throw new RuntimeException('Failed to move uploaded file.');
					}

					// 処理を抜けたら正常終了
					//            echo 'File is uploaded successfully.';

		} catch (RuntimeException $e) {
			throw $e;
		}
		return $uploadFile;
	}
}