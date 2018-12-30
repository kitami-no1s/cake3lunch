<?php
// 独自のCSS
$this->prepend ( 'css', $this->Html->css ( [ 
		'style.css'
] ) );
// BootstrapをCDNから取得
$this->prepend ( 'css', $this->Html->css ( [ 
		'//stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css'
] ) );
// BootstrapのJSをCDNから取得
$this->prepend ( 'script', $this->Html->script ( [ 
		'//stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'
] ) );
$this->prepend ( 'script', $this->Html->script ( [ 
		'//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js'
] ) );
$this->prepend ( 'script', $this->Html->script ( [ 
		'//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js'
] ) );
// jQueryをCDNから取得
$this->prepend ( 'script', $this->Html->script ( [ 
		'//code.jquery.com/jquery-3.3.1.js'
] ) );
?>
<!DOCTYPE html>
<html>
<head>
	<?=$this->Html->charset() ?>
	<?=$this->Html->meta('icon') ?>
	<?=$this->fetch('script') ?>
	<title><?=$this->fetch('title') ?></title>
	<?=$this->fetch('css') ?>
</head>
<body>
	<?=$this->element('menu') ?>
	<?=$this->element('content') ?>
</body>
</html>