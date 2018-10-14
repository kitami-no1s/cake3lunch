<html>
    <head>
        <script type="text/javascript">
            function admin() {
                var role = document.getElementById("role");
                console.log(role);
                if (role.value === "1"){
                    var pass = prompt("管理者パスワード", "");
                    if (pass === "admin"){

                    }else{
                        windows.history.back();
                    }
                }
            };
        </script>
    </head>
    <body>
        <h1 class="page-header">ユーザ登録</h1>
        <?php
            echo $this->Form->create($user);
            echo $this->Form->input('name');
            echo $this->Form->input('password');
            echo $this->Form->controll('role', ['type' => 'checkbox', 'id' => 'role']);
            echo "管理者権限の付与<br/>";
            echo $this->Form->button('登録', ['onclick' => 'admin()']);
            echo $this->Form->end();
        ?>
    </body>
</html>
