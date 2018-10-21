<h1 class="page-header">登録駅一覧</h1>
<table class="table table-striped" cellpadding="0" cellspacing="0">
    <tr>
        <th scope="col"><?= $this->Paginator->sort('id') ?></th>
        <th scope="col"><?= $this->Paginator->sort('name') ?></th>
    </tr>
    <?php foreach ($stations as $station): ?>
        <tr>
            <td><?= $this->Number->format($station->id) ?></td>
            <td><?= h($station->name) ?></td>
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