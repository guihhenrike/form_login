<?php
    include_once("config/processa.php");
    include_once("templates/header.php");
    include_once("templates/navbar.php");
    $usuario = new Usuario;
?>
    <div class="container mt-5">
        <div class="row justify-content-center mt-5">
            <div class="col-md-3">
                <div class="card bg-dark">
                    <h2 class="text-light text-center mt-4">Login</h2>
                        <div class="card-body bg-dark">
                            <form  method="POST">
                                <div class="form-group">
                                    <label for="email">Endereço de e-mail</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Seu e-mail"  required>
                                </div>
                                <div class="form-group">
                                    <label for="senha">Senha</label>
                                    <input type="password" class="form-control" name="senha" id="senha" placeholder="Sua senha" required>
                                </div>
                                <div class="d-flex justify-content-center">
                                <input type="submit" class="btn btn-primary btn-block mt-4 " value="Acessar">
                                </div>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </div>

    <?php //verificar se clicou no botão
    if(isset($_POST['email'])) {
        $email = addslashes($_POST['email']);
        $senha = addslashes($_POST['senha']);
        
        // verificar se nao esta vazio     
        if(!empty($email) && !empty($senha) )
        {
            $usuario->conectar("formulario_guilherme", "localhost", "root", "");
            if($usuario->msgError == "")
            {
                if($usuario->logar($email, $senha))
                {
                    header("location: home.php");
                }
                else 
                {
                ?>
                    <div class="alert alert-danger text-center m-5 text-light bg-danger">
                        <?php echo "Email e/ou senha incorretos!"; ?> //ta vindo direto pra ca
                    </div>
                <?php 
                }
            }
            else 
            {
                echo "Ocorreu um erro -> " . $msgError;
            }
        }
        else
        {
            echo "Preencha todos os campos!";
        }
    }
    ?>

</body>
</html>