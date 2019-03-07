<nav class="navbar navbar-expand navbar-light bg-light">
    <div class="container">
        <span class="navbar-brand mb-0 h1">
            <?=$this->Html->link("cake3lunch", ["controller" =>"Comments", "action" =>"index"], ["class" =>"navbar-brand"]); ?>
        </span>
        <div class="navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li><?=$this->Html->link("ユーザ一覧", "/users/index", ["class" => "nav-link"])?></li>
                <li><?=$this->Html->link("店一覧", "/stores/index", ["class" => "nav-link"])?></li>
                <li><?=$this->Html->link("コメント一覧", "/Comments/index", ["class" => "nav-link"])?></li>
            </ul>
            <ul class="navbar-nav">
                <li><?=$this->Html->link("ログイン", "/users/login", ["class" => "nav-link"])?></li>
                <li><?=$this->Html->link("ユーザ登録", "/users/register", ["class" => "nav-link"])?></li>
            </ul>
        </div>
    </div>
</nav>