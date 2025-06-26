<?php
include_once 'db.php'; // Conexão com o banco

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Corrija aqui conforme o nome da coluna no banco
    $stmt = $pdo->prepare("DELETE FROM produtos WHERE id = ?");
    
    if ($stmt->execute([$id])) {
        header("Location: index.php?msg=sucesso");
        exit();
    } else {
        echo "Erro ao deletar o produto.";
    }
} else {
    echo "ID do produto não foi informado.";
}
?>
