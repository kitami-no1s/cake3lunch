<?php $this->prepend('script',$this->Html->script('stores'));?>
<?php $this->prepend('script',$this->Html->script('stores_jq'));?>
<h1 class="page-header">店登録(仮)</h1>
<?= $this->Form->create();?>
<div>店名</div>
<?= $this->Form->text('name',["div"=>false,"label"=>false])?>
<div>駅名</div>
<?= $this->Form->text('station_name',["div"=>false,"label"=>false,"id"=>'station',"class"=>''])?>
<nobar id="btn"> <nobar id="btn1">五十音から探す&#9654</nobar> <nobar id="btn2">五十音から探す&#9660</nobar>
</nobar>
<div id="target">
	<!-- テンプレート化したい -->
	<div id="akasa">
		あ<br /> <span id="aiu">あ<br /></span> <span id="aiu">い<br /></span> <span
			id="aiu">う<br /></span> <span id="aiu">え<br /></span> <span id="aiu">お<br /></span>
	</div>
	<div id="akasa">
		か<br /> <span id="aiu">か<br /></span> <span id="aiu">き<br /></span> <span
			id="aiu">く<br /></span> <span id="aiu">け<br /></span> <span id="aiu">こ<br /></span>
	</div>
	<div id="akasa">
		た<br /> <span id="aiu">た<br /></span> <span id="aiu">ち<br /></span> <span
			id="aiu">つ<br /></span> <span id="aiu">て<br /></span> <span id="aiu">と<br /></span>
	</div>
	<div id="akasa">
		な<br /> <span id="aiu">な<br /></span> <span id="aiu">に<br /></span> <span
			id="aiu">ぬ<br /></span> <span id="aiu">ね<br /></span> <span id="aiu">の<br /></span>
	</div>
	<div id="akasa">
		は<br /> <span id="aiu">は<br /></span> <span id="aiu">ひ<br /></span> <span
			id="aiu">ふ<br /></span> <span id="aiu">へ<br /></span> <span id="aiu">ほ<br /></span>
	</div>
	<div id="akasa">
		ま<br /> <span id="aiu">ま<br /></span> <span id="aiu">み<br /></span> <span
			id="aiu">む<br /></span> <span id="aiu">め<br /></span> <span id="aiu">も<br /></span>
	</div>
	<div id="akasa">
		や<br /> <span id="aiu">や<br /></span> <span id="aiu">ゆ<br /></span> <span
			id="aiu">よ<br /></span>
	</div>
	<div id="akasa">
		ら<br /> <span id="aiu">ら<br /></span> <span id="aiu">り<br /></span> <span
			id="aiu">る<br /></span> <span id="aiu">れ<br /></span> <span id="aiu">ろ<br /></span>
	</div>
	<div id="akasa">
		わ<br /> <span id="aiu">わ<br /></span> <span id="aiu">を<br /></span> <span
			id="aiu">ん<br /></span>
	</div>
</div>
<!--  ここまで -->
<!-- 五十音検索結果出力 -->
<div id="stations"></div>
<div>住所</div>
<?= $this->Form->text('address',["div"=>false,"label"=>false,"class"=>''])?>
    <?= $this->Form->button('登録');?>
    <?= $this->Form->end();?>