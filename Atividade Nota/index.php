<?php
session_start();
require 'db.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

$stmt = $pdo->query("SELECT * FROM produtos");
$produtos = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerenciamento de Produtos</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <h2>Bem-vindo, <?= htmlspecialchars($_SESSION['usuario_nome']) ?></h2>
    <div class="option">
        <a href="logout.php">Sair</a>
        <a href="adicionar.php">Adicionar Produto</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Preço</th>
                <th>Qtd</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produtos as $produto): ?>
                <tr>
                    <td><?= htmlspecialchars($produto['nome']) ?></td>
                    <td>R$ <?= number_format($produto['preco'], 2, ',', '.') ?></td>
                    <td><?= $produto['quantidade'] ?></td>
                    <td>
                        <a href="editar.php?id=<?= $produto['id'] ?>">Editar</a> |
                        <a href="deletar.php?id=<?= $produto['id'] ?>" onclick="return confirm('Confirmar exclusão?')">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
