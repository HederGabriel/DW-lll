<?php
require_once 'connect.php';

// Cadastrar novo carro
if (isset($_POST['cadastrar'])) {
    $marca = $_POST['marca'];
    $ano = $_POST['ano'];
    $chassi = $_POST['chassi'];
    $cor = $_POST['cor'];
    $placa = $_POST['placa'];

    $sql = "INSERT INTO carros (marca, ano, chassi, cor, placa) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$marca, $ano, $chassi, $cor, $placa]);

    header("Location: Carros.php");
    exit;
}

// Atualizar carro
if (isset($_POST['atualizar'])) {
    if (empty($_POST['id'])) {
        die("Erro: ID do carro não informado para atualização.");
    }

    $id = $_POST['id'];
    $marca = $_POST['marca'];
    $ano = $_POST['ano'];
    $chassi = $_POST['chassi'];
    $cor = $_POST['cor'];
    $placa = $_POST['placa'];

    $sql = "UPDATE carros SET marca = ?, ano = ?, chassi = ?, cor = ?, placa = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $executou = $stmt->execute([$marca, $ano, $chassi, $cor, $placa, $id]);

    if ($executou) {
        header("Location: Carros.php");
        exit;
    } else {
        die("Erro ao atualizar o carro.");
    }
}

// Excluir carro
if (isset($_GET['excluir'])) {
    $id = $_GET['excluir'];
    $sql = "DELETE FROM carros WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    header("Location: Carros.php");
    exit;
}

// Buscar dados para edição
$editar = null;
if (isset($_GET['editar'])) {
    $id = $_GET['editar'];
    $sql = "SELECT * FROM carros WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $editar = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gerenciar Carros</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
        form { margin-bottom: 20px; }
        input[readonly] { background-color: #eee; }
    </style>
</head>
<body>

<button onclick="window.location.href='index.php'">Voltar</button>

<h2><?= $editar ? "Editar Carro" : "Cadastrar Carro" ?></h2>

<form method="post">
    <?php if ($editar): ?>
        <input type="hidden" name="id" value="<?= htmlspecialchars($editar['id']) ?>">
    <?php endif; ?>

    <label>Placa:</label><br>
    <input type="text" name="placa" required value="<?= htmlspecialchars($editar['placa'] ?? '') ?>" <?= $editar ? 'readonly' : '' ?>><br><br>

    <label>Marca:</label><br>
    <input type="text" name="marca" required value="<?= htmlspecialchars($editar['marca'] ?? '') ?>"><br><br>

    <label>Ano:</label><br>
    <input type="number" name="ano" required min="1900" max="<?= date('Y') + 1 ?>" value="<?= htmlspecialchars($editar['ano'] ?? '') ?>"><br><br>

    <label>Chassi:</label><br>
    <input type="text" name="chassi" required value="<?= htmlspecialchars($editar['chassi'] ?? '') ?>"><br><br>

    <label>Cor:</label><br>
    <input type="text" name="cor" required value="<?= htmlspecialchars($editar['cor'] ?? '') ?>"><br><br>

    <button type="submit" name="<?= $editar ? 'atualizar' : 'cadastrar' ?>">
        <?= $editar ? 'Atualizar' : 'Cadastrar' ?>
    </button>
</form>

<hr>

<h2>Lista de Carros</h2>

<table>
    <thead>
        <tr>
            <th>Placa</th>
            <th>Marca</th>
            <th>Ano</th>
            <th>Chassi</th>
            <th>Cor</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $stmt = $pdo->query("SELECT * FROM carros ORDER BY marca");
    foreach ($stmt as $row):
    ?>
        <tr>
            <td><?= htmlspecialchars($row['placa']) ?></td>
            <td><?= htmlspecialchars($row['marca']) ?></td>
            <td><?= htmlspecialchars($row['ano']) ?></td>
            <td><?= htmlspecialchars($row['chassi']) ?></td>
            <td><?= htmlspecialchars($row['cor']) ?></td>
            <td>
                <a href="Carros.php?editar=<?= $row['id'] ?>">Editar</a> |
                <a href="Carros.php?excluir=<?= $row['id'] ?>" onclick="return confirm('Deseja excluir este carro?')">Excluir</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>
