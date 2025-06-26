<?php
session_start();
require 'db.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = ?");
$stmt->execute([$id]);
$produto = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $pdo->prepare("UPDATE produtos SET nome=?, descricao=?, preco=?, quantidade=? WHERE id=?");
    $stmt->execute([
        $_POST['nome'],
        $_POST['descricao'],
        $_POST['preco'],
        $_POST['quantidade'],
        $id
    ]);
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar - Sistema de Produtos</title>
    <link rel="stylesheet" href="./CSS/style.css">
</head>
<body>
    <form method="POST">
        <input name="nome" value="<?= $produto['nome'] ?>" required>
        <textarea name="descricao"><?= $produto['descricao'] ?></textarea>
        <input name="preco" type="number" step="0.01" value="<?= $produto['preco'] ?>" required>
        <input name="quantidade" type="number" value="<?= $produto['quantidade'] ?>" required>
        <button>Atualizar</button>
    </form>

</body>
</html>
