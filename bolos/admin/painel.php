<?php session_start(); 
    $seguranca = isset($_SESSION['ativa']) ? TRUE: header("location:login.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style-adm.css">
    <title>Painel admin</title>
</head>
<body>
<?php if ($seguranca){?>
    <h1>Painel administrarivo</h1>
    <h3>Bem Vindo, <?php echo $_SESSION['nome']; ?></h3>
    <nav>
        <div>
            <a href="users.php">Gerencia</a>
            <a href="../cadastrar_bolos.php">Cadastrar Bolos</a>
            <a href="../index.php">Pagina inicial</a>
            <a href="logout.php">Sair</a>

        </div>
    </nav>

<?php }?>
</body>
<?php include "footer.php"; ?>
</html>