<h1 class="page-header"><?= $station->name ?></h1>
<table class="table table-striped" cellpadding="0" cellspacing="0">
	<tr>
		<th scope="col"><?= $this->Paginator->sort('id') ?></th>
		<th scope="col"><?= $this->Paginator->sort('name') ?></th>
		<th scope="col"><?= $this->Paginator->sort('address') ?></th>
		<th scope="col">投稿する</th>
	</tr>
    
    <?php foreach ($stores as $store):?>
        <tr>
		<td><?= $this->Number->format($store->id) ?></td>
		<td><?= $this->Html->link(h($store->name), ['controller' => 'stores', 'action' => 'comments', $store->id ]); ?></td>
		<td><?= h($store->address) ?></td>
		<td><?= $this->Html->link("投稿する", ['controller' => 'comments','action' => 'add', $store->id ]); ?></td>
	</tr>
    <?php endforeach; ?>
</table>
<?=$this->element('pagination') ?>