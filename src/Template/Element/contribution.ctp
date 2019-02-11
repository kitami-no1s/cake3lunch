<table class="table table-striped" cellpadding="0" cellspacing="0">
    <tr>
        <th scope="col"><?= $this->Paginator->sort('id') ?></th>
        <th scope="col"><?= $this->Paginator->sort('name') ?></th>
        <th scope="col"><?= $this->Paginator->sort('store')?></th>
        <th scope="col"><?= $this->Paginator->sort('comment') ?></th>
        <th scope="col">画像</th>
    </tr>
    <?php foreach ($comments as $comment): ?>
        <tr>
            <td><?= $this->Number->format($comment->id) ?></td>
            <td><?= $comment->user->name; ?></td>
            <td><?= $comment->store->name; ?></td>
            <td><?= $this->Html->link(h($comment->comment),['action' => 'detail',$comment->id]); ?></td>
            <td><?php if (isset($comment->images[0]->image_url)) { ?>
            	<?= $this->Html->image($comment->images[0]->image_url, ['alt' => 'Image', 'width' => '100', 'height' => '100']); ?>
            	<?php }else{ ?>
            	<?= $this->Html->link("画像を追加する", ['controller' => 'images','action' => 'add', $comment->id ]); ?> 
            </td>
        </tr>
    <?php }endforeach; ?>
</table>
