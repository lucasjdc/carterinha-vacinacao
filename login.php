<?php
session_start();
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = new SQLite3('usuarios.db');

    // Dados do formulário
    $nome_usuario = $_POST['nome_usuario'];
    $senha = $_POST['senha'];

    // Verificar se o usuário existe
    $query = "SELECT * FROM usuarios WHERE nome_usuario = '$nome_usuario'";
    $resultado = $db->query($query);
    $usuario = $resultado->fetchArray();

    if ($usuario && password_verify($senha, $usuario['senha'])) {
        // Autenticação bem-sucedida
        $_SESSION['nome_usuario'] = $nome_usuario;
        header('Location: index.php');
    } else {
        // Erro de login
        $error_message = "Nome de usuário ou senha incorretos.";
    }
}

// Armazenar mensagem de erro na sessão
$_SESSION['error_message'] = $error_message;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Login</h1>
    <form action="login.php" method="post">
        <label for="nome_usuario">Nome de Usuário:</label>
        <input type="text" id="nome_usuario" name="nome_usuario" required>
        <br>

        <?php
        // Exibir mensagem de erro, se houver
        if (isset($_SESSION['error_message'])) {
            echo '<p style="color: red;">' . $_SESSION['error_message'] . '</p>';
            // Limpar mensagem de erro da sessão
            unset($_SESSION['error_message']);
        }
        ?>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>
        <br>
        <br>
        <input type="submit" value="Login">
        <p><a href="register.php">Cadastrar</a></p>
    </form>
</body>
</html>
