<h1 class="page-header">画像登録</h1>
<?php
echo $this->Form->create ( $image, [ 
		"enctype" => "multipart/form-data"
] );
for($i=$image_count; $i<3; $i++)
{
    echo $this->Form->input ( 'file_name_'.$i, [ 
    		"type" => "file",
    		"label" => ""
    ] );
}
?>
<?php
echo $this->Form->button ( "画像を登録する" );
echo $this->Form->end ();
?>