<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");

if (!isset($_FILES['foto'])) {
    echo json_encode(["erro" => true, "mensagem" => "Nenhuma foto enviada"]);
    exit;
}

$id_cao = $_POST['id_cao'] ?? null;

if (!$id_cao) {
    echo json_encode(["erro" => true, "mensagem" => "ID do cão não informado"]);
    exit;
}

$foto = $_FILES['foto'];

$pastaFotos = __DIR__ . "/fotos/";

if (!is_dir($pastaFotos)) {
    mkdir($pastaFotos, 0777, true);
}

$ext = strtolower(pathinfo($foto['name'], PATHINFO_EXTENSION));
$nomeArquivo = uniqid("cao_{$id_cao}_") . "." . $ext;

$caminho = $pastaFotos . $nomeArquivo;

if (!move_uploaded_file($foto['tmp_name'], $caminho)) {
    echo json_encode(["erro" => true, "mensagem" => "Erro ao mover arquivo"]);
    exit;
}

$urlFoto = "http://localhost/apicaes/fotos/" . $nomeArquivo;

// SALVA NO BANCO
require_once __DIR__ . "/Fotos.php";
$result = Fotos::incluir([
    "id_cao" => $id_cao,
    "url_foto" => $urlFoto
]);

echo json_encode([
    "erro" => false,
    "mensagem" => "Foto enviada",
    "url" => $urlFoto,
    "db" => $result
]);
