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
    }




?>  