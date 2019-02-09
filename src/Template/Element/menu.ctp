<nav class="navbar navbar-expand navbar-light bg-light">
    <div class="container">
        <span class="navbar-brand mb-0 h1">
            <?=$this->Html->link("cake3lunch", ["controller" =>"Comments", "action" =>"index"], ["class" =>"navbar-brand"]); ?>
        </span>
        <div class="navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li><?=$this->Html->link("ユーザ一覧", "/users/index", ["class" => "nav-link dropdown-item"])?></li>
                <li><?=$this->Html->link("店一覧", "/stores/index", ["class" => "nav-link dropdown-item"])?></li>
                <li><?=$this->Html->link("コメント一覧", "/Comments/index", ["class" => "nav-link dropdown-item"])?></li>
            </ul>
            <ul class="navbar-nav">
                <li class="dropdown">
                    <?=$this->Html->link("管理", "#", ["class" => "nav-link dropdown-toggle","data-toggle" =>"dropdown"]);?>
                    <ul class="dropdown-menu">
                        <li><?=$this->Html->link("ログイン", "/users/login", ["class" => "dropdown-item"])?></li>
                        <li><?=$this->Html->link("登録", "/users/register", ["class" => "dropdown-item"])?></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>