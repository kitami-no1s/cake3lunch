<?php //dump($lists) ?>
<div class="list-group scroll-box">
    <?php foreach($lists as $list){ ?>
        <div class="list-group-item list-group-item-action">
            <?= $this->Html->link($list->stations["name"],"/stations/result/".$list->stations["id"]); ?>
        </div>
    <?php } ?>
</div>