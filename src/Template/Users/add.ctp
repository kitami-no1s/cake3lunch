<h1 class="page-header">ユーザ登録</h1>
<?php
echo $this->Form->create ( $user );
echo $this->Form->input ( 'name' );
echo $this->Form->input ( 'password' );
echo $this->Form->controll ( 'role', [ 
		'type' => 'checkbox',
		'id' => 'role'
] );
echo "管理者権限の付与<br/>";
echo $this->Form->button ( '登録', [ 
		'onclick' => 'admin()'
] );
echo $this->Form->end ();