<?php
include("/var/www/html/guardkeys/db/conexao.php"); // Inclui o arquivo de conexão
$tabela = "empresas";
// Função para verificar se já existe um registro com o mesmo nomeEmpresa 
function chaveJaCadastrada($campo, $valor) {
    global $conn, $tabela;

    $sql = "SELECT * FROM $tabela WHERE $campo = '$valor'";
    $result = $conn->query($sql);

    return $result->num_rows > 0;
}

// Processamento do formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomeEmpresa  = trim($_POST["nomeEmpresa"]);
    $projetoEmpresa = $_POST["projetoEmpresa"];
    $terceiroEmpresa = $_POST["terceiroEmpresa"];
    $nomeResponsavel = $_POST["nomeResponsavel"];
    $emailRespEmpresa = $_POST["emailRespEmpresa"];
    $telRespEmpresa  = $_POST["telRespEmpresa"];
    $nomeRespClaro  = $_POST["nomeRespClaro"];
    $emailRespClaro = $_POST["emailRespClaro"];
    $telRespClaro  = $_POST["telRespClaro"];

    // Verifica se já existe uma chave com o mesmo nomeEmpresa 
    if (chaveJaCadastrada("nomeEmpresa", $nomeEmpresa )) {
        echo "Erro: Empresa ja cadastrada.";
    
    } else {
        // Se não houver duplicatas, realiza a inserção
        $sql = "INSERT INTO $tabela (nomeEmpresa , projetoEmpresa, terceiroEmpresa, nomeResponsavel, emailRespEmpresa, telRespEmpresa, nomeRespClaro, emailRespClaro, telRespClaro ) 
                VALUES ('$nomeEmpresa ', '$projetoEmpresa', '$terceiroEmpresa', '$nomeResponsavel', '$emailRespEmpresa', '$telRespEmpresa ', '$nomeRespClaro', '$emailRespClaro', '$telRespClaro')";

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

<body>

<div class="container">
    <h2>Cadastro de Chaves</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="nomeEmpresa">Nome Empresa:</label>
        <input type="text" name="nomeEmpresa" required>

        <label for="projetoEmpresa">Projeto:</label>
        <select name="projetoEmpresa" required>
            <option value="Implantação RF">Implantação RF</option>
            <option value="Implantação TX">Implantação TX</option>
            <option value="Embratel">Embratel</option>
            <option value="OeM">OeM</option>
            <option value="Infra">Infra</option>
            <option value="Gpon">Gpon</option>
        </select>
        <label for="terceiroEmpresa">Empresa Terceiro:</label>
        <select name="terceiroEmpresa" required>
            <option value="Claro">Claro</option>
            <option value="Ceragon">Ceragon</option>
            <option value="Ericsson">Ericsson</option>
            <option value="Huawei">Huawei</option>
        </select>
        <label for="nomeResponsavel">Nome Responsavel:</label>
        <input type="text" name="nomeResponsavel" required">

        <label for="emailRespEmpresa">Email Responsavel:</label>
        <input type="text" name="emailRespEmpresa" required>

        <label for="telRespEmpresa">Telefone responsavel:</label>
        <input type="text" name="telRespEmpresa" data-mask="(00) 0000-0000" required>

        <label for="nomeRespClaro">Nome Responsavel Claro:</label>
        <input type="text" name="nomeRespClaro" required>

        <label for="emailRespClaro">Email Responsavel Claro:</label>
        <input type="text" name="emailRespClaro" required>

        <label for="telRespClaro">Telefone responsavel Claro:</label>
        <input type="text" name="telRespClaro" required>

        <input type="submit" value="Cadastrar">
    </form>
</div>

</body>
</html>
