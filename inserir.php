<?php
$db = new SQLite3('carteira_vacinacao.db');

// Dados do formulário
$nome_vacina = $_POST['nome_vacina'];
$data_aplicacao = $_POST['data_aplicacao'];
$dose = $_POST['dose'];
$nome_paciente = $_POST['nome_paciente'];
$cpf = $_POST['cpf'];
$data_nascimento = $_POST['data_nascimento'];

// Inserir dados na tabela
$query = "INSERT INTO vacinacoes (nome_vacina, data_aplicacao, dose, nome_paciente, cpf, data_nascimento) 
VALUES ('$nome_vacina', '$data_aplicacao', $dose, '$nome_paciente', '$cpf', '$data_nascimento')";

$db->exec($query);

// Redirecionar de volta para a página principal
header('Location: index.php');
?>
