<?php

namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;

class StoresForm extends Form {
	protected function _buildSchema(Schema $schema) {
		return $schema;
	}
	protected function _buildValidator(Validator $validator) {
		$validator->add ( 'name', 'length', [ 
				'rule' => [ 
						'minLength',
						1
				],
				'message' => '店名は必須です'
		] );
		$validator->add ( 'add', 'length', [ 
				'rule' => [ 
						'minLength',
						1
				],
				'message' => '住所は必須です'
		] );
		return $validator;
	}
	protected function _execute(array $data) {
		$transaction = ConnectionManager::get ( 'default' );
		// トランザクション開始
		$transaction->begin ();
		$this->Stations = TableRegistry::getTableLocator ()->get ( 'stations' );
		$this->StationsStores = TableRegistry::getTableLocator ()->get ( 'stations_stores' );
		$this->Stores = TableRegistry::getTableLocator ()->get ( 'stores' );

		try {
			$store = $this->Stores->newEntity ( [ 
					'name' => $data['name'],
					'address' => $data['address']
			] );
			// 店舗を先に登録
			$store = $this->Stores->save ( $store );
			// 今登録したしたID取得
			$store_id = $store->id;
			$name = $data['station_name'];

			$sub = $this->Stations->find ()->select ( [ 
					'id'
			] )->where ( [ 
					'name' => $name
			] )->first ();

			$this->StationsStores->query ()->insert ( [ 
					'station_id',
					'store_id'
			] )->values ( [ 
					'station_id' => $sub ['id'],
					'store_id' => $store_id
			] )->execute ();
			// トランザクションコミット
			$transaction->commit ();
			
			return true;
		} catch ( \Exception $e ) {
			
			// SQLなかったことにする
			$transaction->rollback ();
			return false;
		}
		return true;
	}
}