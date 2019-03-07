<?php $this->prepend('script',$this->Html->script('comments'));?>
<?= $this->Form->hidden(null,['value'=> $store->id,'id'=>'store_id']); ?>
<h1 class="page-header"><?= $store->name ?>のコメント
    <small><small><small>
        <?= $this->Html->link('投稿する', ['controller' => 'comments', 'action' => 'add', $store->id ]) ?>
    </small></small></small>
</h1>
<?=$this->element('contribution') ?>
<?=$this->element('pagination') ?>
