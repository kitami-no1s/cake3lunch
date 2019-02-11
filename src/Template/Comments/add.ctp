<h1 class="page-header">コメント投稿</h1>
<?php
echo $this->Form->create('Document',["enctype" => "multipart/form-data"]);
echo $this->Form->input( 'comment',[
		'cols'=>'5',
		'label'=>""
] );
?>
<h4 class="page-header">画像を登録</h2>
<?php
echo $this->Form->input ( 'file_name', [
		"type" => "file",
		"label" => ""
] );
echo $this->Form->button ( '登録' );
echo $this->Form->end ();
?>