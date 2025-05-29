<?php
include 'System/db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Consulta com senha em texto puro
    $sql = "SELECT id_pessoa, nome FROM pessoa WHERE email = ? AND senha = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ss", $email, $senha);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $nome);
        $stmt->fetch();

        $_SESSION['id_pessoa'] = $id;
        $_SESSION['nome'] = $nome;

        echo "Login bem-sucedido! Bem-vindo, $nome.";

        header("Location: index.php");
        // exit;
    } else {
        echo "Email ou senha incorretos.";
        header("Location: cadastrar.php");
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>

    <form action="login.php" method="POST">

        <label for="email">Email:</label>
        <input type="email" placeholder="Email" name="email" id="email" required>

        <label for="senha">Senha:</label>
        <input type="password" placeholder="Senha" name="senha" id="senha" required>

        <button type="submit">Entrar</button>

    </form>

</body>
</html>
