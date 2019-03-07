<h1 class="page-header"><?= $station->name ?></h1>
<table class="table table-striped" cellpadding="0" cellspacing="0">
	<tr>
		<th scope="col"><?= $this->Paginator->sort('店名') ?></th>
		<th scope="col"><?= $this->Paginator->sort('住所') ?></th>
		<th scope="col">投稿する</th>
		<th scope="col">地図</th>
	</tr>

    <?php foreach ($stores as $store):?>
        <tr>
		<td><?= $this->Html->link(h($store->name), ['controller' => 'stores', 'action' => 'comments', $store->id ]); ?></td>
		<td class="address"><?= h($store->address) ?></td>
		<td><?= $this->Html->link("投稿する", ['controller' => 'comments','action' => 'add', $store->id ]); ?></td>
		<td id="map">地図が見つかりません</td>
	</tr>
    <?php endforeach; ?>
</table>
<?=$this->element('pagination') ?>
<?= $this->Html->script('google_map')?>