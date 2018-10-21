<h1 class="page-header">店登録(仮)</h1>
<?php
    echo $this->Form->create($store);
    echo $this->Form->input('name');
    echo $this->Form->input('address');
    echo $this->Form->button('登録');
    echo $this->Form->end();