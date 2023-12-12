<?php
include("/var/www/html/guardkeys/db/conexao.php"); // Inclui o arquivo de conexão
$tabela = "chaves";
// Verifica se o ID da chave foi fornecido via GET
if (isset($_GET['id'])) {
    $idChave = $_GET['id'];

    // Query SQL para excluir o registro com base no ID
    $sql = "DELETE FROM $tabela WHERE idChave = $idChave";

    if ($conn->query($sql) === TRUE) {
        $mensagem = "Registro excluído com sucesso!";
    } else {
        $mensagem = "Erro ao excluir o registro: " . $conn->error;
    }
} else {
    $mensagem = "ID da chave não fornecido.";
}

// Fechamento da conexão com o banco de dados
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Chave</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="container">
    <?php
    // Exibe a mensagem
    echo '<p id="mensagem">' . $mensagem . '</p>';
    ?>

    <!-- Retorna para a página lista_chaves_disp.php após 2 segundos -->
    <script>
        setTimeout(function () {
            window.location.href = "lista_chaves_disp.php";
        }, 2000);
    </script>
</div>

</body>
</html>
