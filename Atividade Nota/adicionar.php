<?php 
session_start();
require 'db.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $pdo->prepare("INSERT INTO produtos (nome, descricao, preco, quantidade) VALUES (?, ?, ?, ?)");
    $stmt->execute([
        $_POST['nome'],
        $_POST['descricao'],
        $_POST['preco'],
        $_POST['quantidade']
    ]);
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Adicionar - Sistema de Produtos</title>
    <link rel="stylesheet" href="../Atividade Nota/CSS/style.css">
</head>
<body>
    <h2>Adicionar Novo Produto</h2>
    <div class="option"><a href="index.php">Voltar para a lista</a></div>

    <form method="POST">
        <label for="nome">Nome do Produto</label>
        <input name="nome" id="nome" placeholder="Nome" required>

        <label for="descricao">Descrição</label>
        <textarea name="descricao" id="descricao" placeholder="Descrição"></textarea>

        <label for="preco">Preço</label>
        <input name="preco" id="preco" type="number" step="0.01" placeholder="Preço" required>

        <label for="quantidade">Quantidade</label>
        <input name="quantidade" id="quantidade" type="number" placeholder="Quantidade" required>

        <button type="submit">Salvar</button>
    </form>
</body>
</html>
