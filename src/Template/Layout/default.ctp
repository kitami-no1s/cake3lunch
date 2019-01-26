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
// google map apiの読み込み
$this->prepend ('script',$this->Html->script ([
		"https://maps.googleapis.com/maps/api/js?key={GOOGLE_MAP}&callback=initMap"
]));
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
    <div class="container">
        <div class="row">
            <div class ="col-12">
                <?=$this->element($menu) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-2">
                <?=$this->element('sidebar') ?>
            </div>
            <div class="col-10">
                <?=$this->element('content') ?>
            </div>
        </div>
    </div>
</body>
</html>