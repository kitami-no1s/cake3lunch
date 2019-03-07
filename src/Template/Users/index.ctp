<h1 class="page-header">ユーザ一覧</h1>
<table class="table table-striped" cellpadding="0" cellspacing="0">
	<tr>
		<th scope="col"><?= $this->Paginator->sort('name') ?></th>
		<th scope="col"><?= $this->Paginator->sort('role') ?></th>
		<th scope="col">ユーザごとの投稿</th>
	</tr>
    <?php foreach ($users as $user): ?>
    <tr>
		<td><?= h($user->name) ?></td>
		<td><?= h($user->role) ?></td>
		<td><?= $this->Html->link("投稿を見る", ['controller' => 'comments', 'action' => 'index', $user->id ]); ?></td>
	</tr>
    <?php endforeach; ?>
</table>
<div class="paginator">
	<ul class="pagination">
        <?=$this->Paginator->numbers ( [ 'before' => $this->Paginator->first ( "<<" ),'after' => $this->Paginator->last ( ">>" )] )?>
    </ul>
</div>