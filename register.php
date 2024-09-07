<?php
// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new SQLite3('usuarios.db');

    // Dados do formulário
    $nome_usuario = $_POST['nome_usuario'];
    $senha = password_hash($_POST['senha'], PASSWORD_BCRYPT);

    // Iserir o usuário na tabela
    $query = "INSERT INTO usuarios (nome_usuario, senha) VALUES ('$nome_usuario', '$senha')";
    $db->exec($query);

    // Criar um banco de dados para o novo usuário
    $db_usuario = new SQLite3("{nome_usuario}_carteira_vacinacao.db");
    $query_criar_tabela = "CREATE TABLE IF NOT EXIST vacinacoes (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nome_vacina TEXT,
        data_aplicacao TEXT,
        dose INTEGER
        nome_paciente TEXT,
        cpf TEXT
        data_nascimento TEXT
    )";
    $db_usuario->exec($query_criar_tabela);

    header('Location: login.php');
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuários</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Registrar Novo Usuário</h1>
    <form action="register.php" method="post">
        <label for="nome_usuario">Nome de Usuário:</label>
        <input type="text" id="nome_usuario" name="nome_usuario" required>
        <br>
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>
        <br>
        <input type="submit" value="Registrar">
    </form>
</body>
</html>

