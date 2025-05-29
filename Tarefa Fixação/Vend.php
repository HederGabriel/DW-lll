<?php
require_once 'connect.php';

// Cadastrar novo vendedor
if (isset($_POST['cadastrar'])) {
    $cpf = $_POST['id_cpf'];
    $nome = $_POST['nome'];
    $loja = $_POST['loja'];
    $data_nasc = $_POST['data_nasc'];

    $sql = "INSERT INTO vendedor (id_cpf, nome, loja, data_nasc) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$cpf, $nome, $loja, $data_nasc]);

    header("Location: Vend.php");
    exit;
}

// Atualizar vendedor
if (isset($_POST['atualizar'])) {
    $cpf = $_POST['id_cpf'];
    $nome = $_POST['nome'];
    $loja = $_POST['loja'];
    $data_nasc = $_POST['data_nasc'];

    $sql = "UPDATE vendedor SET nome = ?, loja = ?, data_nasc = ? WHERE id_cpf = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome, $loja, $data_nasc, $cpf]);

    header("Location: Vend.php");
    exit;
}

// Excluir vendedor
if (isset($_GET['excluir'])) {
    $cpf = $_GET['excluir'];
    $sql = "DELETE FROM vendedor WHERE id_cpf = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$cpf]);

    header("Location: Vend.php");
    exit;
}

// Buscar dados para edição
$editar = null;
if (isset($_GET['editar'])) {
    $cpf = $_GET['editar'];
    $sql = "SELECT * FROM vendedor WHERE id_cpf = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$cpf]);
    $editar = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gerenciar Vendedores</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
        form { margin-bottom: 20px; }
    </style>
</head>
<body>

<button onclick="window.location.href='index.php'">Voltar</button>

<h2><?= $editar ? "Editar Vendedor" : "Cadastrar Vendedor" ?></h2>

<form method="post">
    <label>CPF:</label><br>
    <input type="text" name="id_cpf" required value="<?= $editar['id_cpf'] ?? '' ?>" <?= $editar ? 'readonly' : '' ?>><br><br>

    <label>Nome:</label><br>
    <input type="text" name="nome" required value="<?= $editar['nome'] ?? '' ?>"><br><br>

    <label>Loja:</label><br>
    <input type="text" name="loja" required value="<?= $editar['loja'] ?? '' ?>"><br><br>

    <label>Data de Nascimento:</label><br>
    <input type="date" name="data_nasc" required value="<?= $editar['data_nasc'] ?? '' ?>"><br><br>

    <button type="submit" name="<?= $editar ? 'atualizar' : 'cadastrar' ?>">
        <?= $editar ? 'Atualizar' : 'Cadastrar' ?>
    </button>
</form>

<hr>

<h2>Lista de Vendedores</h2>

<table>
    <thead>
        <tr>
            <th>CPF</th>
            <th>Nome</th>
            <th>Loja</th>
            <th>Data Nasc.</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $stmt = $pdo->query("SELECT * FROM vendedor ORDER BY nome");
    foreach ($stmt as $row):
    ?>
        <tr>
            <td><?= htmlspecialchars($row['id_cpf']) ?></td>
            <td><?= htmlspecialchars($row['nome']) ?></td>
            <td><?= htmlspecialchars($row['loja']) ?></td>
            <td><?= htmlspecialchars($row['data_nasc']) ?></td>
            <td>
                <a href="Vend.php?editar=<?= $row['id_cpf'] ?>">Editar</a> |
                <a href="Vend.php?excluir=<?= $row['id_cpf'] ?>" onclick="return confirm('Deseja excluir este vendedor?')">Excluir</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>
