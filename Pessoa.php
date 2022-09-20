<?php 

    Class Pessoa {

        private $pdo;

        // Conexão com o Banco de dados
        public function __construct($dbname, $host, $user, $password) { 
            try {
                $this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host,$user,$password );
            }
            catch (PDOException $e) {
                echo "Erro com o banco de dados: ".$e->getMessage();
                exit();
            } catch (Exception $e) {
                echo "Erro: ".$e->getMessage();
                exit();
            }
        }
        public function buscarDados() {
            $res = array(); // só para caso banco de dados estar vazio, não der erro.
            $cmd = $this->pdo->query("SELECT * FROM pessoa ORDER BY id DESC");
            $res = $cmd->fetchAll(PDO::FETCH_ASSOC); // transfomra as informações recebicas em array e assoc para economizar memória
            return $res;
        }

        // função de cadrastar pessoas no banco de dados
        public function cadrastarPessoa($nome, $telefone, $email) {
            // verificar se já foi cadrastado anteriormente com base no email
            $cmd = $this->pdo->prepare("SELECT id from pessoa WHERE email = :e");
            $cmd->bindValue(":e", $email);
            $cmd->execute();

            if($cmd->rowCount() > 0) {
                return false;
            }else { //não foi encontrado o email
                $cmd = $this->pdo->prepare("INSERT INTO pessoa (nome, telefone, email) VALUES (:n, :t, :e)");
                $cmd->bindValue(":n", $nome); //subistituir
                $cmd->bindValue(":t", $telefone);
                $cmd->bindValue(":e", $email); 
                $cmd->execute();
                return true;
            }

        }

        public function excluirPessoa($id) {
            $cmd = $this->pdo->prepare("DELETE from pessoa WHERE id = :id");
            $cmd->bindValue(":id",$id);
            $cmd->execute();
        }

        // Buscar dados de uma pessoa 
        public function buscarDadosPessoa($id) {
            $res = array(); //previnindo erro, caso não retorne nada do banco, aparecera um array vazio.
            $cmd = $this->pdo->prepare("SELECT * FROM pessoa WHERE id = :id");
            $cmd->bindValue(":id",$id);
            $cmd->execute();
            $res = $cmd->fetch(PDO::FETCH_ASSOC);
            return $res;
        }


        // Atualizar dados no banco de dados 
        public function atualizarDados() {

        } 
    }

?>  