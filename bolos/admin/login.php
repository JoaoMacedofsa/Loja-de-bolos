<?php  require_once 'functions.php'; 
        if (isset($_POST['acessar'])){
            login($conn);
        }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style-adm.css">
    <title>Pagina de Login</title>
</head>
<body>
    <form action="" method="post">
        <fieldset>
            <legend>Painel de Login</legend>
            <input type="email" name="email" placeholder="email" required>
            <input type="password" name="senha" placeholder="senha" required>
            <input type="submit" name="acessar" value="accessar">
        </fieldset>
    </form>
</body>
<?php include "footer.php"; ?>
</html>