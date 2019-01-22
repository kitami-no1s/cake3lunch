<nav class="navbar navbar-light bg-light">
	<span class="navbar-brand mb-0 h1">
    <?=$this->Html->link("cake3lunch", ["controller" =>"Users", "action" =>"index"], ["class" =>"navbar-brand"]); ?>
  </span>
	<div class="navbar-collapse">
		<ul class="nav navbar-nav navbar-left">
			<li class="dropdown">
        <?=$this->Html->link("管理", "#", ["class" => "dropdown-toggle","data-toggle" =>"dropdown"]);?>
        <ul class="dropdown-menu">
					<li><?=$this->Html->link("ログイン", "/users/login", ["class" => "dropdown-item"])?></li>
					<li><?=$this->Html->link("登録", "/users/register", ["class" => "dropdown-item"])?></li>
				</ul>
			</li>
		</ul>
	</div>
</nav>