<h1 class="page-header">登録店一覧</h1>
<table class="table table-striped" cellpadding="0" cellspacing="0">
<?= $this->Form->hidden("cnt",['value'=> $cnt ]) ?>
	<tr>
		<th scope="col"><?= $this->Paginator->sort('id') ?></th>
		<th scope="col"><?= $this->Paginator->sort('name') ?></th>
		<th scope="col">station</th>
		<th scope="col"><?= $this->Paginator->sort('address') ?></th>
		<th scope="col">投稿する</th>
		<th scope="col">地図</th>
	</tr>
	<?php $i=0;?>
    <?php foreach ($stores as $store):?>
        <tr>
		<td><?= $this->Number->format($store->id) ?></td>
		<td><?= h($store->name) ?></td>
		<td>
            <?php foreach ($store->stations as $station): ?>
            	<?= h($station->name) ?>&nbsp
            <?php endforeach;?>
            </td>
		<td id="<?= "address".$i;?>"><?= h($store->address) ?></td>
		<td><?= $this->Html->link("投稿する", ['controller' => 'comments','action' => 'add', $store->id ]); ?></td>
		<td id="<?= "map".$i;?>"></td>
		<?php $i+=1;?>
	</tr>
    <?php endforeach; ?>
</table>

<?=$this->element('pagination') ?>
<?php $this->prepend('script',$this->Html->script('google_map'));?>
