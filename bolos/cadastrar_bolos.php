<?php
session_start(); 
$seguranca = isset($_SESSION['ativa']) ? TRUE: header("location:admin/login.php");

// Inclui o arquivo de funções
include "admin/functions.php";

// Verifica se a requisição é do tipo POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtém os dados do formulário
    $nome_bolo = $_POST['nome_bolo'];
    $preco_bolo = $_POST['preco_bolo'];
    $imagem_url = $_POST['imagem_url'];

    // Chama a função para adicionar o bolo
    adicionarBolo($nome_bolo, $preco_bolo, $imagem_url);
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Bolo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style-cadastro.css">
</head>
<body>
<?php include "nav.php";?>
<?php if ($seguranca){?>
    <div class="container my-5">
        <h1 class="text-center">Adicionar Novo Bolo</h1>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="nome_bolo" class="form-label">Nome do Bolo</label>
                <input type="text" class="form-control" id="nome_bolo" name="nome_bolo" required>
            </div>
            <div class="mb-3">
                <label for="preco_bolo" class="form-label">Preço do Bolo</label>
                <input type="number" class="form-control" id="preco_bolo" name="preco_bolo" required step="0.01">
            </div>
            <div class="mb-3">
                <label for="imagem_url" class="form-label">URL da Imagem</label>
                <input type="text" class="form-control" id="imagem_url" name="imagem_url" required>
            </div>
            <button type="submit" class="btn btn-primary">Adicionar Bolo</button>
        </form>
    </div>
<?php }?>
</body>
<?php include "footer.php"; ?>
</html>
