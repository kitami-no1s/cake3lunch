<table class="table table-striped" cellpadding="0" cellspacing="0">
    <tr>
        <th scope="col"><?= $this->Paginator->sort('投稿者') ?></th>
        <th scope="col"><?= $this->Paginator->sort('店名')?></th>
        <th scope="col"><?= $this->Paginator->sort('コメント') ?></th>
        <th scope="col">画像</th>
    </tr>
    <?php foreach ($comments as $comment): ?>
        <tr>
            <td><?= $comment->user->name; ?></td>
            <td><?= $comment->store->name; ?></td>
            <td><?= $this->Html->link(h($comment->comment),['controller' => 'comments', 'action' => 'detail',$comment->id]); ?></td>
            <td><?php if (isset($comment->images[0]->image_url)) { ?>
            	<?= $this->Html->image($comment->images[0]->image_url, ['alt' => 'Image', 'width' => '100', 'height' => '100']); ?>
            	<?php }else{ ?>
            	<?= $this->Html->link("画像を追加する", ['controller' => 'images','action' => 'add', $comment->id ]); ?>
            </td>
        </tr>
    <?php }endforeach; ?>
</table>
