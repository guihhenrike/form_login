<?php
    include_once("config/processa.php");
    include_once("templates/header.php");
    include_once("templates/navbar.php");
    $usuario = new Usuario;
?>

  <div class="container mt-5">
    <div class="row justify-content-center text-light">
      <div class="col-md-6">
        <div class="card bg-dark border-0 rounded">
          <div class="card-header text-light text-center bg-dark border-0">
            <h4>Cadastro</h4>
          </div>
          <div class="card-body">
            <form action="cadastrar.php" method="POST">
              <div class="form-group text-light mt-2">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" name="nome" id="nome" placeholder="Digite seu nome" maxlength="30" required>
              </div>
              <div class="form-group text-light mt-2">
                  <label for="email">E-mail</label>
                  <input type="email" class="form-control" name="email" id="email" placeholder="Digite seu e-mail" maxlength="40" required>
                </div>
                <div class="form-group text-light mt-2">
                  <label for="senha">Senha</label>
                  <input type="password" class="form-control" name="senha" id="senha" placeholder="Digite sua senha" maxlength="15" required>
                </div>
                <div class="form-group text-light mt-2">
                  <label for="confirmarSenha">Confirmar Senha</label>
                  <input type="password" class="form-control" name="confirmarSenha" id="confirmarSenha" placeholder="Confirme sua senha" maxlength="15" required>
                </div>
                
                <div class="form-group text-light mt-2">
                  <label>Sexo</label>
                  <div class="form-check text-light">
                    <input class="form-check-input" type="radio" name="sexo" id="masculino" value="masculino">
                    <label class="form-check-label text-light" for="masculino">
                      Masculino
                    </label>
                  </div>
                  <div class="form-check text-light ">
                    <input class="form-check-input" type="radio" name="sexo" id="feminino" value="feminino">
                    <label class="form-check-label text-light" for="feminino">
                      Feminino
                    </label>
                  </div>
                </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card bg-dark border-0 rounded">
          <div class="card-header text-light text-center bg-gradient-radial-custom border-0">
            <h4>Cadastro</h4>
          </div>
          <div class="card-body">
            <div class="form-group text-light col-4 mt-2">
                  <label for="data_nasc">Data de Nascimento</label>
                  <input type="date" class="form-control" name="data_nasc" id="data_nasc" required>
                </div>
                <div class="form-group text-light mt-2">
                  <label for="telefone">Telefone</label>
                  <input type="tel" class="form-control" name="telefone" id="telefone" placeholder="(xx) xxxxx-xxxx" maxlength="25" required>
                </div>
                <div class="form-group text-light mt-2">
                  <label for="cidade">Cidade</label>
                  <input type="text" class="form-control" name="cidade" id="cidade" placeholder="Digite sua cidade" maxlength="40" required>
                </div>
                <div class="form-group text-light mt-2">
                  <label for="estado">Estado</label>
                  <input type="text" class="form-control" name="estado" id="estado" placeholder="Digite seu estado" maxlength="30" required>
                </div>
                <div class="form-group text-light  mt-2">
                  <label for="endereco">Endereço</label>
                  <input type="text" class="form-control" name="endereco" id="endereco" placeholder="Digite seu endereço" maxlength="50" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block mt-5">Cadastrar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>  
  
  <?php //verificar se clicou no botão
    if(isset($_POST['nome'])) {
        $nome = addslashes($_POST['nome']);
        $email = addslashes($_POST['email']);
        $telefone = addslashes($_POST['telefone']);
        $sexo = addslashes($_POST['sexo']);
        $data_nasc = addslashes($_POST['data_nasc']);
        $cidade = addslashes($_POST['cidade']);
        $estado = addslashes($_POST['estado']);
        $endereco = addslashes($_POST['endereco']);
        $senha = addslashes($_POST['senha']);
        $confirmarSenha = addslashes($_POST['confirmarSenha']);
          // verificar se nao esta vazio
        
          if(!empty($nome) && !empty($email) && !empty($senha) && !empty($confirmarSenha) && !empty($telefone) && !empty($sexo)
           && !empty($data_nasc) && !empty($cidade) && !empty($estado) && !empty($endereco)) {
            
              $usuario->conectar("formulario_guilherme", "localhost", "root", "");
              
              if($msgError == "") { // esta tudo ok
                if($senha == $confirmarSenha) {
                 
                  if($usuario->cadastrar($nome, $email, $senha, $telefone, $sexo, $data_nasc, $cidade, $estado, $endereco))
                  {
                    ?>
                      <div class="alert alert-success text-center m-5">
                        <?php echo "Cadastrado com Sucesso, "; ?> <a href="login.php">Acesse para entrar ! </a>
                      </div>
                    <?php
                  }
                  else
                  {
                    ?>
                      <div class="alert alert-danger text-center m-5 text-light bg-danger">
                      <?php echo "Email já cadastrado!"; ?>
                      </div>
                    <?php                  }
                }
                else
                {
                  ?>
                  <div class="alert alert-danger text-center m-5 text-light bg-danger">
                  <?php echo "Senha e confirmar senha não correspondem."; ?>
                  </div>
                <?php                   }

              } 
              else
              {
                ?>
                <div class="alert alert-danger text-center m-5 text-light bg-danger">
                <?php echo "Erro de conexaão -> " . $msgError; ?>
                </div>
              <?php                 } 


          } 
          else
          {
            ?>
            <div class="alert alert-danger text-center m-5 text-light bg-danger">
            <?php echo "Preencha todos os campos!"; ?>
            </div>
          <?php             }


    }




  ?>





  <!-- Importando os arquivos JS do Bootstrap -->
  <script src="https://code.jquery.com/jquery-3.3."
</body>


</html>