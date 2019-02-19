<?= $this->Form->hidden(null,['value'=> $cnt,'id'=>'cnt' ]) ?>
<h1 class="page-header">登録店一覧</h1>
<table class="table table-striped" cellpadding="0" cellspacing="0">
	<tr>
		<th scope="col"><?= $this->Paginator->sort('name') ?></th>
		<th scope="col">station</th>
		<th scope="col"><?= $this->Paginator->sort('address') ?></th>
		<th scope="col">投稿する</th>
		<th scope="col">地図</th>
	</tr>
    <?php foreach ($stores as $store):?>
    <tr>
		<?= $this->Form->hidden(null,['value'=> $store->id]) ?>
		<td><?= h($store->name) ?></td>
		<td>
            <?php foreach ($store->stations as $station): ?>
            	<?= h($station->name) ?>&nbsp
            <?php endforeach;?>
            </td>
		<td class="address"><?= h($store->address) ?></td>
		<td id="post"><?= $this->Html->link("投稿する", ['controller' => 'comments','action' => 'add', $store->id ]); ?></td>
		<td id="map">地図が見つかりません</td>
	</tr>
    <?php endforeach; ?>
</table>

<?=$this->element('pagination') ?>
<?= $this->Html->script('google_map')?>