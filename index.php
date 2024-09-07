<?php
// Conexão com o banco de dados SQLite
$db = new SQLite3('carteira_vacinacao.db');

// Consultar as vacinações no banco de dados
$query = "SELECT * FROM vacinacoes";
$results = $db->query($query);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carteira de Vacinação</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Carteira de Vacinação</h1>
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
