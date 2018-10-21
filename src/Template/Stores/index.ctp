<h1 class="page-header">登録店一覧</h1>
<table class="table table-striped" cellpadding="0" cellspacing="0">
    <tr>
        <th scope="col"><?= $this->Paginator->sort('id') ?></th>
        <th scope="col"><?= $this->Paginator->sort('name') ?></th>
        <th scope="col"><?= $this->Paginator->sort('address') ?></th>
        <th scope="col">投稿する</th>
    </tr>
    <?php foreach ($stores as $store): ?>
        <tr>
            <td><?= $this->Number->format($store->id) ?></td>
            <td><?= h($store->name) ?></td>
            <td><?= h($store->address) ?></td>
            <td><?= $this->Html->link("投稿する", ['controller' => 'comments','action' => 'add', $store->id ]); ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<div class="paginator">
    <ul class="pagination">
        <?=$this->Paginator->numbers([
            'before' => $this->Paginator->first("<<"),
            'after'  => $this->Paginator->last(">>"),
        ]) ?>
    </ul>
</div>
