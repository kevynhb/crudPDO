<?php 
//----------------------------CONEXÃO------------------------------------
// evitar erros try catch
try{
    // Conexão com banco de dados
    // passar informações: dbname e host no primeiro parametro, usuario e senha no segundo parametro
    $pdo = new PDO("mysql:dbname=CRUDPDO;host=localhost", "root", "");

} 
catch (PDOException $e) {
    echo "Erro com banco de dados: " . $e->getMessage();
} 
catch (Exception $e) {
    echo "Erro generico: " . $e->getMessage();

}


//----------------------------INSERT------------------------------------

// Duas formas de inserir dados prepare(), query()
// 1° forma e mais utilizada, serve para passar um parametro e depois substituir
// $res = $pdo->prepare("INSERT INTO pessoa(nome, telefone, email)
//     VALUES (:n, :t, :e)");

// // Metodo de subistituir os parametros
// $res->bindValue(":n","Joao"); // aceita váriaveis e funções 
// $res->bindValue(":t","3412-0320");
// $res->bindValue(":e","joao-da-silva@gmail.com");
// $res->execute();

// 2° forma de iserir dados no banco, query() não precisa fazer substituição, vai diretamente
// passa valores diretamente e quando não se tem parametros para passar.
// $pdo->query("INSERT INTO pessoa(nome, telefone, email) VALUES 
//     ('Kevyn', '0932-3230', 'meeEmail@gmail.com')");


//----------------------------DELETE------------------------------------
// $cod = $pdo->prepare("DELETE FROM pessoa WHERE id = :id");
// $id = 1;
// $cod->bindValue(":id", $id);
// $cod->execute();

// $cod = $pdo->query("DELETE FROM pessoa WHERE id = '1'")
// $cod = $pdo->query("DELETE FROM pessoa") //apaga toda a tabela pessoa


//----------------------------UPDATE------------------------------------
// $cod = $pdo->prepare("UPDATE pessoa SET email = :e WHERE id = :id");

// $cod->bindValue(":e", "teste@gmail.com");
// $cod->bindValue(":id", "2");
// $cod->execute();

// $cod = $pdo->query("UPDATE pessoa SET telefone = '0000-0000' WHERE id = '2'");


//----------------------------INSERT------------------------------------

$cod = $pdo->prepare("SELECT * FROM pessoa WHERE id = :id");
$cod->bindValue(":id", 3);
$cod->execute();
// esse comado vai seleciona a informação pedida e vai guardar na variavel $cod
// não vem em formato array
// função para transformar essa informação em array
$resultado = $cod->fetch(PDO::FETCH_ASSOC); // parametro PDO para retornar apenas os nomes das colunas do BD
 //// fetch: uma unica linha/registro do banco de dados
// $cod->fetchAll(); // mais de um registro do BD

foreach ($resultado as $key => $value){
    echo $key.": ".$value."<br>";
}
?>