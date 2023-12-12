<?php
include("/var/www/html/guardkeys/db/conexao.php"); // Inclui o arquivo de conexão
$tabela = "chaves";
// Função para obter os dados da chave pelo ID
function obterChavePorId($id) {
    global $conn, $tabela;

    $sql = "SELECT * FROM $tabela WHERE idChave = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return false;
    }
}

// Inicializa as variáveis
$mensagem = "";

// Processamento do formulário de edição
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $numeroChave = $_POST["numeroChave"];
    $tipoChave = $_POST["tipoChave"];
    $nomeChave = $_POST["nomeChave"];
    $codChave = $_POST["codChave"];
    $regChave = $_POST["regChave"];

    $sql = "UPDATE $tabela SET 
            numeroChave = '$numeroChave', 
            tipoChave = '$tipoChave', 
            nomeChave = '$nomeChave', 
            codChave = '$codChave', 
            regChave = '$regChave' 
            WHERE idChave = $id";

    if ($conn->query($sql) === TRUE) {
        $mensagem = "Registro atualizado com sucesso!";
        echo '<script>
                setTimeout(function() {
                    window.location.href = "editar.php?id=' . $id . '";
                }, 5000);
              </script>';
    } else {
        $mensagem = "Erro ao atualizar registro: " . $conn->error;
    }
}

// Verifica se o ID foi passado via GET
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $chave = obterChavePorId($id);

    if ($chave) {
        $numeroChave = $chave["numeroChave"];
        $tipoChave = $chave["tipoChave"];
        $nomeChave = $chave["nomeChave"];
        $codChave = $chave["codChave"];
        $regChave = $chave["regChave"];
    } else {
        $mensagem = "Chave não encontrada.";
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
    <title>Editar Chave</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="container">
    <h2>Editar Chave</h2>

    <?php
    // Exibe a mensagem
    if (!empty($mensagem)) {
        echo '<p id="mensagem">' . $mensagem . '</p>';
    }
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <label for="numeroChave">Número da Chave:</label>
        <input type="text" name="numeroChave" value="<?php echo $numeroChave; ?>" required>

        <label for="tipoChave">Tipo de Chave:</label>
        <input type="text" name="tipoChave" value="<?php echo $tipoChave; ?>" required>

        <label for="nomeChave">Nome da Chave:</label>
        <input type="text" name="nomeChave" value="<?php echo $nomeChave; ?>" required>

        <label for="codChave">Código da Chave:</label>
        <input type="text" name="codChave" value="<?php echo $codChave; ?>" required>

        <label for="regChave">Região da Chave:</label>
        <select name="regChave" required>
            <option value="11" <?php echo ($regChave == '11') ? 'selected' : ''; ?>>11</option>
            <option value="12" <?php echo ($regChave == '12') ? 'selected' : ''; ?>>12</option>
            <option value="13" <?php echo ($regChave == '13') ? 'selected' : ''; ?>>13</option>
            <option value="14" <?php echo ($regChave == '14') ? 'selected' : ''; ?>>14</option>
            <option value="15" <?php echo ($regChave == '15') ? 'selected' : ''; ?>>15</option>
            <option value="16" <?php echo ($regChave == '16') ? 'selected' : ''; ?>>16</option>
            <option value="17" <?php echo ($regChave == '17') ? 'selected' : ''; ?>>17</option>
            <option value="18" <?php echo ($regChave == '18') ? 'selected' : ''; ?>>18</option>
            <option value="19" <?php echo ($regChave == '19') ? 'selected' : ''; ?>>19</option>
        </select>

        <input type="submit" value="Salvar Alterações">
    </form>
</div>

<script>
// Adiciona um script para esconder a mensagem após alguns segundos
setTimeout(function() {
    var mensagem = document.getElementById('mensagem');
    if (mensagem) {
        mensagem.style.display = 'none';
    }
}, 5000); // Esconde a mensagem após 5 segundos (ajuste conforme necessário)
</script>

</body>
</html>
