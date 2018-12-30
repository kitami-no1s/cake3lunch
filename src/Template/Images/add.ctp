<h1 class="page-header">画像登録</h1>
<?php
echo $this->Form->create ( $image, [ 
		"enctype" => "multipart/form-data"
] );
echo $this->Form->input ( 'file_name', [ 
		"type" => "file",
		"label" => ""
] );
?>
<?php
echo $this->Form->button ( "画像を登録する" );
echo $this->Form->end ();
?>