<?php 

    Class Usuario
    {
        private $conn;
        public $msgError = ''; // esta ok

        public function conectar ($dbName, $host, $dbUser, $dbPassword) 
        {
            global $conn;
            global $msgError; 
        
            try{
                $conn = new PDO("mysql:dbname=". $dbName . ";host=" . $host, $dbUser, $dbPassword);
            } catch(PDOException $e) {
                $msgError = $e->getMessage();
            }
        }

        public function cadastrar($nome, $email, $telefone, $sexo, $data_nasc, $cidade, $estado, $endereco, $senha)
        {
            global $conn; 
            //verificar se o email ja existe 
            
            $sql = $conn->prepare("SELECT id FROM usuarios WHERE email = :email");
            $sql->bindValue(":email", $email);          
            $sql->execute();
            
            if($sql->rowCount() > 0)
            {
                return false; // ja esta cadastrado
            }
            else
            {
                $sql = $conn->prepare("INSERT INTO usuarios (nome, email, senha, telefone, sexo, data_nasc, cidade, estado, endereco)
                                       VALUES(:nome, :email, :telefone, :sexo, :data_nasc, :cidade, :estado, :endereco, :senha)");
                $sql->bindValue(":nome", $nome);
                $sql->bindValue(":email", $email);
                $sql->bindValue(":telefone", $telefone);
                $sql->bindValue(":sexo", $sexo);
                $sql->bindValue(":data_nasc", $data_nasc);
                $sql->bindValue(":cidade", $cidade);
                $sql->bindValue(":estado", $estado);
                $sql->bindValue(":endereco", $endereco);
                $sql->bindValue(":senha", md5($senha));

                $sql->execute();

                return true; // cadastrado com sucesso
            }
        }

        public function logar($email, $senha)
        {
            global $conn; 
            //verificar se o email e senha estao cadastrados, se sim
            $sql = $conn->prepare("SELECT id FROM usuarios WHERE email = :email AND senha = :senha");
            $sql->bindValue(":email", $email);
            $sql->bindValue(":senha", md5($senha));

            $sql->execute();

            if($sql->rowCount() > 0) {
                // entrar no sistema (SESSAO)
                $dados = $sql->fetch();
                session_start();
                $_SESSION['id'] = $dados['id'];
                return true;
            } else {
                return false; // não foi possivel logar
            }
        }


    }



?>