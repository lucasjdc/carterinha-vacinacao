<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['nome_usuario'])) {
    header('location: login.php');
    exit;
}

// Conectar ao banco de dados específico do usuário
$nome_usuario = $_SESSION['nome_usuario'];
$db = new SQLite3("{$nome_usuario}_carteria_vacinacao.db}");

// Conexão com o banco de dados SQLite
$db = new SQLite3('carteira_vacinacao.db');

// Verificar se a tabela 'vacinacoes' existe e criar se não existir
$query = "CREATE TABLE IF NOT EXISTS vacinacoes (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nome_vacina TEXT NOT NULL,
    data_aplicacao TEXT NOT NULL,
    dose INTEGER NOT NULL,
    nome_paciente TEXT NOT NULL,
    cpf TEXT NOT NULL,
    data_nascimento TEXT NOT NULL
)";
$db->exec($query);

// Consultar as vacinações no banco de dados
$query = "SELECT * FROM vacinacoes";
$results = $db->query($query);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carteira de Vacinação - <?php echo htmlspecialchars($nome_usuario); ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Carteira de Vacinação</h1>
        <p>Bem-vindo, <?php echo htmlspecialchars($nome_usuario) ?></p>
        <a href="logout.php">Sair</a>
    </header>

    <main>
        <section class="table-section">
            <h2>Vacinações Registradas</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nome da Vacina</th>
                        <th>Data de Aplicação</th>
                        <th>Dose</th>
                        <th>Nome do Paciente</th>
                        <th>CPF</th>
                        <th>Data de Nascimento</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $results->fetchArray()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['nome_vacina']); ?></td>
                        <td><?php echo htmlspecialchars($row['data_aplicacao']); ?></td>
                        <td><?php echo htmlspecialchars($row['dose']); ?></td>
                        <td><?php echo htmlspecialchars($row['nome_paciente']); ?></td>
                        <td><?php echo htmlspecialchars($row['cpf']); ?></td>
                        <td><?php echo htmlspecialchars($row['data_nascimento']); ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </section>

        <section class="form-section">
            <h2>Inserir Nova Vacinação</h2>
            <form action="inserir.php" method="post">
                <div class="form-group">
                    <label for="nome_vacina">Nome da Vacina:</label>
                    <input type="text" id="nome_vacina" name="nome_vacina" required>
                </div>

                <div class="form-group">
                    <label for="data_aplicacao">Data de Aplicação:</label>
                    <input type="date" id="data_aplicacao" name="data_aplicacao" required>
                </div>

                <div class="form-group">
                    <label for="dose">Dose:</label>
                    <input type="number" id="dose" name="dose" required>
                </div>

                <div class="form-group">
                    <label for="nome_paciente">Nome do Paciente:</label>
                    <input type="text" id="nome_paciente" name="nome_paciente" required>
                </div>

                <div class="form-group">
                    <label for="cpf">CPF:</label>
                    <input type="text" id="cpf" name="cpf" required>
                </div>

                <div class="form-group">
                    <label for="data_nascimento">Data de Nascimento:</label>
                    <input type="date" id="data_nascimento" name="data_nascimento" required>
                </div>

                <div class="form-group">
                    <input type="submit" value="Inserir">
                </div>
            </form>
        </section>
    </main>
</body>
</html>
