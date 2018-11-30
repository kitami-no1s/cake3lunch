<h1 class="page-header">投稿一覧(仮)</h1>
<table class="table table-striped" cellpadding="0" cellspacing="0">
    <tr>
        <th scope="col"><?= $this->Paginator->sort('id') ?></th>
        <th scope="col"><?= $this->Paginator->sort('comment') ?></th>
        <th scope="col">画像</th>
    </tr>
    <?php foreach ($comments as $comment): ?>
        <tr>
            <td><?= $this->Number->format($comment->id) ?></td>
            <td><?= h($comment->comment) ?></td>
            <td><?php if (isset($comment->images[0]->image_url)) { ?>
            	<?= $this->Html->image($comment->images[0]->image_url, ['alt' => 'Image', 'width' => '100', 'height' => '100']); ?>
            	<?php }else{ ?>
            	<?= $this->Html->link("画像を追加する", ['controller' => 'images','action' => 'add', $comment->id ]); ?> 
            </td>
        </tr>
    <?php }endforeach; ?>
</table>
<div class="paginator">
    <ul class="pagination">
        <?=$this->Paginator->numbers([
            'before' => $this->Paginator->first("<<"),
            'after'  => $this->Paginator->last(">>"),
        ]) ?>
    </ul>
</div>