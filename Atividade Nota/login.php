<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($senha, $user['senha'])) {
        $_SESSION['usuario_id'] = $user['id'];
        $_SESSION['usuario_nome'] = $user['nome'];
        header("Location: index.php");
        exit;
    } else {
        $erro = "Login inválido!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - Sistema de Produtos</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <h2>Login</h2>

    <?php if (!empty($erro)): ?>
        <p style="color: red;"><?= htmlspecialchars($erro) ?></p>
    <?php endif; ?>

    <form method="POST">
        <label for="email">Email</label>
        <input name="email" id="email" type="email" placeholder="Email" required>

        <label for="senha">Senha</label>
        <input name="senha" id="senha" type="password" placeholder="Senha" required>

        <button type="submit">Entrar</button>
    </form>

    <p>Não tem conta? <a href="registrar.php">Cadastre-se</a></p>
</body>
</html>
