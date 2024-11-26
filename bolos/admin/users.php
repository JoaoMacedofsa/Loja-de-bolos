<?php session_start(); 
    $seguranca = isset($_SESSION['ativa']) ? TRUE: header("location:login.php");
    require_once "functions.php";

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style-adm.css">
    <title>Painel admin - Funcionários</title>
</head>
<body>
<?php if ($seguranca){?>
    <h1>Painel administrarivo - Funcionários</h1>
    <h3>Bem Vindo, <?php echo $_SESSION['nome']; ?></h3>
    <h2>Gerenciador de funcionários</h2>
    <nav>
        <div>
            <a href="painel.php">Painel</a>
            <a href="../index.php">Pagina inicial</a>
            <a href="../cadastrar_bolos.php">Cadastrar Bolos</a>
            <a href="logout.php">Sair</a>
        </div>
    </nav>

<?php
    $tabela = "funcionarios"; 
    $funcionarios = buscar($conn, $tabela); 
    inserirUsuarios($conn);
    if (isset($_GET['id'])){?>
        <h3>Tem certeza que deseja deletar o funcionario <?php echo $_GET['nome'];?>.</h3>;
        <form action="" method="post">
            <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
            <input type="submit" name="deletar" value="Deletar">
        </form>
    <?php }?>
    <?php if(isset($_POST['deletar'])){
        if($_SESSION['id'] != $_POST['id']){
            deletar($conn, "funcionarios", $_POST['id']);
            echo '<div class="mensagem-sucesso">Funcionário deletado com sucesso!</div>';
        }else{
            echo '<div class="mensagem-erro">Não é possível deletar a própria conta!</div>';
        }
       } 

    ?>


    <form action="" method="post">
        <fieldset>
            <legend>Inserir Funcionario</legend>
            <input type="text" name="nome" placeholder="Nome">
            <input type="email" name="email" placeholder="E-mail">
            <input type="password" name="senha" placeholder="Senha">
            <input type="password" name="repetesenha" placeholder="Confirmar Senha">
            <input type="submit" name="cadastrar" value="Cadastrar">
        </fieldset>
    </form>

    <div class="container">
        <table border='1'>
            <thead>
                <tr>
                    <th>id</th>
                    <th>Nome</th>
                    <th>email</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($funcionarios as $funcionario){?>
                    <tr>
                        <td> <?php echo $funcionario['id'];?></td>
                        <td> <?php echo $funcionario['nome'];?></td>
                        <td> <?php echo $funcionario['email'];?></td>
                        <td><a href="users.php?id=<?php 
                            echo $funcionario['id'];
                            ?>&nome=<?php 
                            echo $funcionario['nome'];
                            ?>">Excluir</a>
                        </td>
                    </tr>
                    <?php }?>
            </tbody>
        </table>
    </div>
 <?php
 require_once "functions.php";
 $servername = "localhost";
 $username = "root";
 $password = "";
 $dbname = "bolos"; // Nome do banco de dados

 // Criar a conexão
 $connB = new mysqli($servername, $username, $password, $dbname);
    // Gerenciar Bolos
   $tabela_bolos = "bolo"; 
   $bolos = buscar($connB, $tabela_bolos); 

   if (isset($_GET['id_bolo'])){?>
    <h3>Tem certeza que deseja deletar o bolo <?php echo $_GET['nome_bolo'];?>.</h3>;
    <form action="" method="post">
        <input type="hidden" name="id_bolo" value="<?php echo $_GET['id_bolo'];?>">
        <input type="submit" name="deletar_bolo" value="Deletar">
    </form>
    <?php }?>
<?php
   if(isset($_POST['deletar_bolo'])){
        deletarB($connB, $tabela_bolos, $_POST['id_bolo']);  
        echo '<div class="mensagem-sucesso">Bolo deletado com sucesso!</div>';
   } 

?> 
    <!-- Tabela de Bolos -->
    <h2>Lista de Bolos</h2>
    <div class="container">
        <table border='1'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Imagem</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($bolos as $bolo){?>
                    <tr>
                        <td><?php echo $bolo['id_bolo']; ?></td>
                        <td><?php echo $bolo['nome_bolo']; ?></td>
                        <td><?php echo $bolo['preco']; ?></td>
                        <td><img src="<?php echo $bolo['imagem_url']; ?>"></td>
                        <td>
                            <a href="users.php?id_bolo=<?php echo $bolo['id_bolo']; ?>&nome_bolo=<?php echo $bolo['nome_bolo']; ?>">Excluir</a>
                        </td>
                    </tr>
                <?php }?>
            </tbody>
        </table>
    </div>

<?php }?>
</body>
<?php include "footer.php"; ?>
</html>