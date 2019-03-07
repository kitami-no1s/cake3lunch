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
            	<?= $this->Html->image($comment->images[0]->image_url, ['alt' => 'Image', 'width' => '90', 'height' => '90']); ?>
            	<?php if (count($comment->images) < 3 && $comment->user_id == $user) {?>
                		<?= $this->Html->link("画像追加", ['controller' => 'images','action' => 'add', $comment->id ]); }?> 
            	<?php }elseif($comment->user_id == $user){ ?>
            	<?= $this->Html->link("画像追加", ['controller' => 'images','action' => 'add', $comment->id ]); ?>
            </td>
        </tr>
    <?php }endforeach; ?>
</table>
