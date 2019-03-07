<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;
use Cake\Datasource\ConnectionManager;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use RuntimeException;

class ImagesController extends AppController
{
     public function initializa()
        {
            parent::initialize();

        }

        public function isAuthorized($user = null)
        {
            return true;
        }
	public function add($comment_id=null)
	{
		$user_id=$this->Auth->user('id');

		try{
			$comment=$this->Images->Comments->get($comment_id);
		}catch(\Exception $e){
			$this->Flash->error(__('error'));
			return $this->redirect(['controller'=>'Users','action'=>'index']);
		}
		if($comment->user_id !== $user_id){
			$this->Flash->error(__("編集権限がありません"));
			return $this->redirect(['controller'=>'Users','action'=>'index']);
		}
		$image=$this->Images->newEntity();

		if($this->request->is('post')){
			//dump($this->request->data['file_name']);
			//move_upload_file
			$dir = realpath(WWW_ROOT . "/img");
			$limitFileSize = 1024 * 1024;
			$temp['file']="";
			try {
				$temp['file'] = $this->file_upload($this->request->data['file_name'], $dir, $limitFileSize);
				//dump($temp);
			} catch (RuntimeException $e){
				//$this->Flash->error(__('ファイルのアップロードができませんでした.'));
				//$this->Flash->error(__($e->getMessage()));
				$this->Flash->error(__('画像が選択されていません'));
				return $this->redirect(['controller'=>'Users', 'action'=>'index']);
			}
			$image->image_url=$temp['file'];
                        $image->comment_id = $comment_id;
			$image=$this->Images->patchEntity($image,$this->request->data);
			if($this->Images->save($image)){
				$this->Flash->success(__('画像を登録しました'));
			}else{
				$this->Flash->error(__('画像の登録に失敗しました'));
			}
			return $this->redirect(['controller'=>'Comments','action'=>'index']);
                }
                $this->set(compact('image'));

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

			// エラーのチェック
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

	public function change($product_id)
	{
		if($this->request->is(['patch','post','put'])){
			//dump($this->request->data["id"]);
			$this->mainImageQuery($product_id);
			$this->Images
				->query()
				->update()
				->set(['main_image'=>1])
				->where(['id'=>$this->request->data["id"]])
				->execute();
			$this->Flash->success(__('main画像を変更しました'));
			return $this->redirect(['controller'=>'products','action'=>'detail',$product_id]);
		}
		$this->Flash->error(__('main画像の変更に失敗しました'));
		return $this->redirect(['controller'=>'MyPages','action'=>'index']);
	}

	private function mainImageQuery($product_id)
	{
		$product = $this->Images
		->query()
		->update()
		->set(['main_image' => 0])
		->where(['product_id' => $product_id])
		->execute();
	}

	private function mainImageCount($product_id)
	{
		$c=$this->Images
			->find()
			->where(['product_id'=>$product_id])
			->andwhere(['main_image'=>1])
			->count();
		return $c;
	}

}