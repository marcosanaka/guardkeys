<?php
include("/var/www/html/guardkeys/db/conexao.php"); // Inclui o arquivo de conexão
$tabela = "chaves";
// Função para verificar se já existe um registro com o mesmo númeroChave ou codChave
function chaveJaCadastrada($campo, $valor) {
    global $conn, $tabela;

    $sql = "SELECT * FROM $tabela WHERE $campo = '$valor'";
    $result = $conn->query($sql);

    return $result->num_rows > 0;
}

// Processamento do formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numeroChave = $_POST["numeroChave"];
    $tipoChave = $_POST["tipoChave"];
    $nomeChave = $_POST["nomeChave"];
    $codChave = $_POST["codChave"];
    $regChave = $_POST["regChave"];

    // Verifica se já existe uma chave com o mesmo numeroChave
    if (chaveJaCadastrada("numeroChave", $numeroChave)) {
        echo "Erro: Já existe uma chave com o mesmo número de chave.";
    }
    // Verifica se já existe uma chave com o mesmo codChave
    elseif (chaveJaCadastrada("codChave", $codChave)) {
        echo "Erro: Já existe uma chave com o mesmo código de chave.";
    } else {
        // Se não houver duplicatas, realiza a inserção
        $sql = "INSERT INTO $tabela (numeroChave, tipoChave, nomeChave, codChave, regChave) 
                VALUES ('$numeroChave', '$tipoChave', '$nomeChave', '$codChave', '$regChave')";

        if ($conn->query($sql) === TRUE) {
            echo "Registro inserido com sucesso!";
        } else {
            echo "Erro ao inserir registro: " . $conn->error;
        }
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
    <title>Cadastro de Chaves</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="container">
    <h2>Cadastro de Chaves</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="numeroChave">Número da Chave:</label>
        <input type="text" name="numeroChave" required>

        <label for="tipoChave">Tipo de Chave:</label>
        <select name="tipoChave" required>
            <option value="MULTILOCK">MULTILOCK</option>
            <option value="CLIQ">CLIQ</option>
            <option value="PADRAO">PADRAO</option>
            <option value="TETRA">TETRA</option>
            <option value="PADRAO ESPECIAL">PADRAO ESPECIAL</option>
        </select>

        <label for="nomeChave">Nome da Chave:</label>
        <input type="text" name="nomeChave" required>

        <label for="codChave">Código da Chave:</label>
        <input type="text" name="codChave" required>

        <label for="regChave">Região da Chave:</label>
        <select name="regChave" required>
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

        <input type="submit" value="Cadastrar">
    </form>
</div>

</body>
</html>
