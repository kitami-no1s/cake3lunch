<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <?=$this->Html->link("cake3lunch", ["controller" =>"Users", "action" =>"index"], ["class" =>"navbar-brand"]); ?>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <?=$this->Html->link("ユーザ", "#",["data-toggle" =>"dropdown"]); ?>
                    <ul class="dropdown-menu">
                        <li><?=$this->Html->link("一覧", "/users/index"); ?>
                        <li><?=$this->Html->link("編集", "/users/edit"); ?>
                        <li><?=$this->Html->link("追加", "/users/add"); ?>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <?=$this->Html->link("管理", "#", ["data-toggle" =>"dropdown"]);?>
                    <ul class="dropdown-menu">
                        <li><?=$this->Html->link("ログイン", "/users/login")?></li>
                        <li><?=$this->Html->link("登録", "/users/register")?></li>
                        <li><?=$this->Html->link("ログアウト", "/users/logout")?></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>