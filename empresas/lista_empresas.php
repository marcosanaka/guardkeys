<?php
include("/var/www/html/guardkeys/db/conexao.php"); // Inclui o arquivo de conexão
$tabela = "chaves";
// Inicializa as variáveis
$mensagem = "";
$chavesDisponiveis = [];

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $regChaveSelecionado = $_POST["regChave"];
    $nomeChaveSelecionado = $_POST["nomeChave"];

    // Constrói a consulta SQL com base nos parâmetros fornecidos
    $sql = "SELECT * FROM $tabela WHERE statusChave = 0";

    if (!empty($regChaveSelecionado)) {
        $sql .= " AND regChave = $regChaveSelecionado";
    }

    if (!empty($nomeChaveSelecionado)) {
        $sql .= " AND nomeChave LIKE '%$nomeChaveSelecionado%'";
    }

    $result = $conn->query($sql);

    // Armazena as chaves disponíveis
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $chavesDisponiveis[] = $row;
        }
    } else {
        $mensagem = "Nenhuma chave disponível com os critérios informados.";
    }
}

// Fechamento da conexão com o banco de dados
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chaves Disponíveis</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="container">
    <h2>Chaves Disponíveis</h2>

    <?php
    // Exibe a mensagem, se houver
    if (!empty($mensagem)) {
        echo '<p id="mensagem">' . $mensagem . '</p>';
    }
    ?>

    <!-- Formulário para selecionar a região e/ou nome da chave -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="regChave">Selecione a Região da Chave:</label>
        <select name="regChave">
            <option value="">Todos</option>
            <option value="11">11</option>
            <option value="12">12</option>
            <option value="13">13</option>
            <option value="14">14</option>
            <option value="15">15</option>
            <option value="16">16</option>
            <option value="17">17</option>
            <option value="18">18</option>
            <option value="19">19</option>
        </select>

        <label for="nomeChave">Digite o Nome da Chave:</label>
        <input type="text" name="nomeChave">

        <input type="submit" value="Buscar Chaves">
    </form>

    <?php
    // Exibe as chaves disponíveis, se houver
    if (count($chavesDisponiveis) > 0) {
    echo '<h3>Chaves Disponíveis</h3>';
    echo '<ul>';
    foreach ($chavesDisponiveis as $chave) {
        echo '<li>';
        echo 'Chave: ' . $chave['numeroChave'] . ' - Tipo: ' . $chave['tipoChave'] . ' - Nome: ' . $chave['nomeChave'] . ' - CN: ' . $chave['regChave'];
        echo '<div class="icons">';
        echo '<a href="editar_chaves.php?id=' . $chave['idChave'] . '"><img src="img/editar-icon.png" alt="Editar"></a>';
        echo '<a href="excluir_chaves.php?id=' . $chave['idChave'] . '"><img src="img/excluir-icon.png" alt="Excluir"></a>';
        echo '</div>';
        echo '</li>';
    }
    echo '</ul>';
}
    ?>
</div>

</body>
</html>

