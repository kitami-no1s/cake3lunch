<?php $this->prepend('script',$this->Html->script('stores_jq'));?>
<h1 class="page-header">店登録(仮)</h1>
<?= $this->Form->create();?>
<div>店名</div>
<?= $this->Form->text('name',["div"=>false,"label"=>false])?>
<div>駅名</div>
<?= $this->Form->text('station_name',["div"=>false,"label"=>false,"id"=>'station',"class"=>''])?>
<?= $this -> Form -> button ( "検索", [ "id" => "search","type"=>"button"])?>
<div id="btn"> <nobar id="btn1">五十音から探す&#9654</nobar> <nobar id="btn2">五十音から探す&#9660</nobar>
</div>
<div id="target">
	<!-- テンプレート化したい -->
	<?= $this->element('aiu')?>
</div>
<!--  ここまで -->
<!-- 五十音検索結果出力 -->
<div id="stations"></div>
<div>住所</div>
<?= $this->Form->text('address',["div"=>false,"label"=>false,"class"=>''])?>
    <?= $this->Form->button('登録');?>
    <?= $this->Form->end();?>
    <div id="map"></div>
    <?php $this->prepend('script',$this->Html->script('google_map'));?>
