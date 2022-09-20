<?php 
    // Chamando a classe
    require_once 'Pessoa.php';
    // Instanciando a classe
    $p = new Pessoa("crudpdo", "localhost", "root", ""); // Objeto da classe pessoa
?>

<html lang="pt-br">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD com PHP</title>
    <link rel="stylesheet" href="style.css">
 </head>
 <body>

    <?php 
        if (isset($_POST['nome'])) {
            $nome = addslashes($_POST['nome']);
            $telefone = addslashes($_POST['telefone']);
            $email = addslashes($_POST['email']);
            if (!empty($nome) && !empty($telefone) && !empty($email)) { // se não estiver vazio
                //cadrastar
                if (!$p->cadrastarPessoa($nome, $telefone, $email)){ // se o retorno for false, executa esse if
                    echo"Email já está cadrastado!";
                }
            }else {
                echo "Preencha todos os campos";
            }
        }

        if(isset($_GET['id_up'])) {
            $id_update = addslashes($_GET['id_up']);
            $res = $p->buscarDadosPessoa($id_update); // envia para a função
        }
    ?>

    <section id="left">

        <form method="POST">
            <h2>Cadrastar Pessoa</h2>

            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" value="<?php if(isset($res)){echo $res['nome'];}?>">

            <label for="telefone">telefone</label>
            <input type="text" name="telefone" id="telefone" value="<?php if(isset($res)){echo $res['telefone'];}?>">

            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" value="<?php if(isset($res)){echo $res['email'];}?>">
            
            <input type="submit" value="<?php if(isset($res)){echo "Atualizar";}else{echo "Cadrastar";}?>">
        </form>

    </section>
    <!-- -------------------------------------------------------------- -->
    <section id="right">
        <table>
            <tr id="titulo"> <!-- linha-->
                <td> <!-- coluna -->
                    Nome
                </td>
                <td>Telefone</td>
                <td colspan="2">E-mail</td>
            </tr>

        <?php 
            $dados = $p->buscarDados();
            if (count($dados) > 0) {
                for ($i = 0; $i < count($dados); $i++) { // perorre o array ate que atinja o tamanho dele
                    echo "<tr>";
                    foreach ($dados[$i] as $k => $v) {
                        if ($k != "id") {
                            echo "<td>".$v."</td>";
                        }
                    }
                    ?>
                    <td>
                        <a href="index.php?id_up=<?php echo $dados[$i]['id'] ?>">Editar</a>
                        <a href="index.php?id=<?php echo $dados[$i]['id'] ?>">Excluir</a>
                    </td>
                    <?php
                    echo "</tr>";
                }
            }else { // O banco esta vazio
                echo "Ainda não há pessoas cadrastadas!";
            }
        ?>
        </table>

    </section>
 </body>
 </html>

 <?php 
    if(isset($_GET['id'])) { 
        $id_pessoa = addslashes($_GET['id']); // pega o id informado
        $p->excluirPessoa($id_pessoa); // passa o id para a função excluir
        header("location: index.php"); //atualiza a página  
    }
 ?>