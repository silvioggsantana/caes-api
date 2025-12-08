<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");

// --- VALIDA O ARQUIVO ---
if (!isset($_FILES['foto'])) {
    echo json_encode(["erro" => true, "mensagem" => "Nenhuma foto enviada"]);
    exit;
}

$foto = $_FILES['foto'];

// --- CRIA PASTA /fotos SE NÃO EXISTIR ---
$pastaFotos = __DIR__ . "/fotos/";

if (!is_dir($pastaFotos)) {
    mkdir($pastaFotos, 0777, true);
}

// --- GERA NOME ÚNICO ---
$extensao = strtolower(pathinfo($foto['name'], PATHINFO_EXTENSION));
$nomeArquivo = uniqid("cao_{$id_cao}_") . "." . $extensao;

// --- CAMINHO REAL PARA SALVAR ---
$caminhoFinal = $pastaFotos . $nomeArquivo;

// --- MOVE O ARQUIVO ---
if (!move_uploaded_file($foto['tmp_name'], $caminhoFinal)) {
    echo json_encode(["erro" => true, "mensagem" => "Erro ao mover arquivo"]);
    exit;
}

// --- URL DE ACESSO NO NAVEGADOR ---
$urlFoto = "http://localhost/apicaes/fotos/" . $nomeArquivo;

// --- SALVA NO BANCO ---
require_once __DIR__ . "/api/Fotos.php";

$result = Fotos::incluir([
    "id_cao" => $id_cao,
    "url_foto" => $urlFoto
]);

// --- RETORNA JUNTO COM A URL ---
echo json_encode([
    "erro" => false,
    "mensagem" => "Foto enviada com sucesso",
    "url" => $urlFoto,
    "db" => $result
]);
