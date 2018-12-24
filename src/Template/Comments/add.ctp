<h1 class="page-header">コメント投稿</h1>
<?php
    echo $this->Form->create($comment);
    echo $this->Form->input('comment');
    echo $this->Form->button('登録');
    echo $this->Form->end();
