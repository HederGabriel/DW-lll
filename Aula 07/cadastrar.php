<?php include 'System/db.php' ?>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verifica se o email já está cadastrado
    $check = $conexao->prepare("SELECT id_pessoa FROM pessoa WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo "Este email já está cadastrado.";
    } else {
        $sql = "INSERT INTO pessoa (nome, email, senha) VALUES (?, ?, ?)";
        $stmt = $conexao->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("sss", $nome, $email, $senha);
            if ($stmt->execute()) {
                echo "Cadastro realizado com sucesso!";
            } else {
                echo "Erro ao cadastrar: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Erro na preparação da query: " . $conexao->error;
        }
    }

    $check->close();
}
?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>
<body>

    <form action="cadastrar.php" method="POST">

        <label for="nome">Nome:</label>
        <input type="text" placeholder="Nome" name="nome" id="nome" required>

        <label for="email">Email:</label>
        <input type="email" placeholder="Email" name="email" id="email" required>

        <label for="senha">Senha:</label>
        <input type="password" placeholder="Senha" name="senha" id="senha" required>

        <button type="submit">Cadastrar</button>
    </form>

</body>
</html>
