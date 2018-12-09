<h1 class="page-header">駅登録</h1>
<?php
echo $this->Form->create ( $station );
echo $this->Form->input ( 'name' );
echo $this->Form->button ( '登録' );
echo $this->Form->end ();