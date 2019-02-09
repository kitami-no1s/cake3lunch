<nav class="navbar navbar-expand navbar-light bg-light">
    <div class="container">
        <span class="navbar-brand mb-0 h1">
            <?=$this->Html->link("cake3lunch", ["controller" =>"Comments", "action" =>"index"], ["class" =>"navbar-brand"]); ?>
        </span>
        <div class="navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="dropdown">
                    <?=$this->Html->link("ユーザ", "#",["class" => "nav-link dropdown-toggle","data-toggle" =>"dropdown"]); ?>
                    <ul class="dropdown-menu">
                        <li><?=$this->Html->link("一覧", "/users/index", ["class" => "dropdown-item"]); ?>
                        <li><?=$this->Html->link("編集", "/users/edit", ["class" => "dropdown-item"]); ?>
                        <li><?=$this->Html->link("追加", "/users/add", ["class" => "dropdown-item"]); ?>
                    </ul>
                </li>
                <li class="dropdown">
                    <?=$this->Html->link("店舗", "#", ["class" => "nav-link dropdown-toggle","data-toggle" =>"dropdown"]);?>
                    <ul class="dropdown-menu">
                        <li><?=$this->Html->link("店舗登録", "/stores/register", ["class" => "dropdown-item"])?></li>
                        <li><?=$this->Html->link("駅登録", "/stations/register", ["class" => "dropdown-item"])?></li>
                        <li><?=$this->Html->link("料理登録", "/images/register", ["class" => "dropdown-item"])?></li>
                    </ul>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="dropdown">
                    <?=$this->Html->link("管理", "#", ["class" => "nav-link dropdown-toggle","data-toggle" =>"dropdown"]);?>
                    <ul class="dropdown-menu">
                        <li><?=$this->Html->link("ログアウト", "/users/logout", ["class" => "dropdown-item"])?></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
