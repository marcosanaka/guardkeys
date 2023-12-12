<?php
// Configuração do banco de dados
$nomeBanco = "chavesdb";
$host = "localhost";
$usuarioDB = "root";
$senha = "M@rcos1984";

// Conexão com o banco de dados
$conn = new mysqli($host, $usuarioDB, $senha, $nomeBanco);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}
?>
