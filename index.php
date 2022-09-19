<?php 
    // Chamando a classe
    require_once 'Pessoa.php';
    // Instanciando a classe
    $p = new Pessoa("crudpdo", "localhost", "root", "");
?>

<html lang="pt-br">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD com PHP</title>
    <link rel="stylesheet" href="style.css">
 </head>
 <body>

    <section id="left">

        <form action="">
            <h2>Cadrastar Pessoa</h2>

            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome">

            <label for="telefone">telefone</label>
            <input type="text" name="telefone" id="telefone">

            <label for="email">E-mail</label>
            <input type="text" name="email" id="email">
            
            <input type="submit" value="Cadrastar">
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
                    <td><a href="">Editar</a><a href="">Excluir</a></td>
                    <?php
                    echo "</tr>";
                }
            
            }

        ?>

    
        </table>

    </section>

 </body>
 </html>