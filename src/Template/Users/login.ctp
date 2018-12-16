<h1 class="page-header">ログイン</h1>
<?php
echo $this->Form->create ( $user );
echo $this->Form->input ( 'name' );
echo $this->Form->input ( 'password' );
echo $this->Form->button ( 'ログイン' );
echo $this->Form->end ();
