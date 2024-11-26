<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "empresa";

$conn = mysqli_connect($host, $user, $password, $dbname);

function login($conn){
    // if (isset($_POST['accessar']) AND !empty($_POST['email']) AND !empty($_POST['senha'])){}
    if (!empty($_POST['email']) AND !empty($_POST['senha'])){
        $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
        $senha = sha1($_POST['senha']);
        $query = "SELECT * FROM funcionarios WHERE email = '$email' AND senha = '$senha'";
        $executar = mysqli_query($conn, $query);
        $return = mysqli_fetch_assoc($executar);
        if (!empty($return['email'])){
            session_start();
            $_SESSION['nome'] = $return['nome'];
            $_SESSION['id'] = $return['id'];
            $_SESSION['ativa'] = TRUE;
            header("location: painel.php");
        }
        else{
            echo "Usuario não encontrado";
        }
    }
}

function logout(){
    session_start();
    session_unset();
    session_destroy();
    header('location: login.php');
}

function buscaUnica($conn, $tabela, $id){
    $query = "SELECT * FROM $tabela WHERE id =".(int) $id;
    $executar = mysqli_query($conn, $query);
    $result = mysqli_fetch_assoc($executar);
    return $result;
}

function buscar($conn, $tabela, $where=1, $order=""){
    if (!empty($order)){
        $order = "ORDER BY $order";
    }
    $query = "SELECT * FROM $tabela WHERE $where $order";
    $executar = mysqli_query($conn, $query);
    $result = mysqli_fetch_all($executar, MYSQLI_ASSOC);
    return $result;
}

function inserirUsuarios($conn){
    if ((isset($_POST['cadastrar']) AND !empty($_POST['email']) AND !empty($_POST['senha']))){
        $erros = array();
        $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
        $nome = mysqli_real_escape_string($conn, $_POST['nome']);
        $senha = sha1($_POST['senha']);

        if ($_POST['senha'] != $_POST['repetesenha']){
            $erros[] = "Senhas não conferem";
        }

        $queryEmail = "SELECT email FROM funcionarios WHERE email = '$email'";
        $buscaEmail = mysqli_query($conn, $queryEmail);
        $verifica = mysqli_num_rows($buscaEmail);

        if (!empty($verifica)){
            $erros[] = "E-mail já cadastrado";
        }

        if (empty($erros)){
            $query = "INSERT INTO funcionarios (nome, email, senha) VALUES ('$nome', '$email', '$senha')";
            $executar = mysqli_query($conn, $query);
            if($executar){
                echo "Funcionário cadastrado com sucesso!";
            }else{
                echo "Erro ao cadastrar funcionário";
            }

        }else{
            foreach($erros as $erro){
                echo "<p>$erro</p>";
            }
        }
    }
}

function deletar($conn, $tabela, $id){
    if (!empty($id)){
        $query = "DELETE FROM $tabela WHERE id = $id";
        $executar = mysqli_query($conn, $query);
        // if($executar){
        //     echo "Funcionário deletado com sucesso!";
        // }else{
        //     echo "Erro ao deletar funcionário";
        // }
    }
}

function deletarB($conn, $tabela, $id){
    if (!empty($id)){
        $query = "DELETE FROM $tabela WHERE id_bolo = $id";
        $executar = mysqli_query($conn, $query);
        // if($executar){
        //     echo "Funcionário deletado com sucesso!";
        // }else{
        //     echo "Erro ao deletar funcionário";
        // }
    }
}

function conectarBanco() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bolos"; // Nome do banco de dados

    // Criar a conexão
    $connB = new mysqli($servername, $username, $password, $dbname);
    
    return $connB;
}

function adicionarBolo($nome, $preco, $imagemUrl) {
    $connB = conectarBanco();

    // Verifica se os campos não estão vazios
    if (!empty($nome) && !empty($preco) && !empty($imagemUrl)) {
        // Prepara a query para inserir os dados no banco de dados
        $sql = "INSERT INTO bolo (nome_bolo, preco, imagem_url) VALUES (?, ?, ?)";
        
        $stmt = $connB->prepare($sql);
        $stmt->bind_param("sds", $nome, $preco, $imagemUrl); // String, Decimal, String
        
        if ($stmt->execute()) {
            echo "Bolo adicionado com sucesso!";
        } else {
            echo "Erro ao adicionar bolo: " . $stmt->error;
        }
        
        $stmt->close();
    } else {
        echo "Por favor, preencha todos os campos.";
    }

    $connB->close();
}


function buscarBolos($conn) {
    $sql = "SELECT * FROM bolo";
    $result = $conn->query($sql);

    if (!$result) {
        die("Erro na consulta SQL: " . $conn->error);
    }

    return $result;
}


?>