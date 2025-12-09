<?php

// Habilita CORS — permite que seu front em outra origem consuma a API
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

// Responde pré-requisição OPTIONS (quando o navegador faz preflight)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

    include_once 'AdocoesService.php' ;
    include_once 'CaesService.php' ;
    include_once 'UsuariosService.php' ;
    include_once 'FotosService.php' ;
    include_once 'util.php' ;
    include_once 'LoginService.php';


    if( @$_GET['url'] ) {
        $url = explode( '/' , $_GET['url'] )  ;


        if ($url[0] === 'api') {
            array_shift($url);

            // Remove .php e coloca primeira letra maiúscula
            $classe = str_replace('.php', '', $url[0]);
            $service = ucfirst($classe) . "Service";

            $method = $_SERVER["REQUEST_METHOD"];

            array_shift($url);

            try {
                $response = call_user_func_array([new $service, $method], $url);
                http_response_code(200);
                echo FormatarMensagemJson($response["erro"], $response["mensagem"], $response["dados"]);
            } catch (Exception $erro) {
                http_response_code(500);
                echo FormatarMensagemJson(true, $erro->getMessage(), []);
            }

        } else {
            echo "Endpoint incorreto";
        }
    } else {
        echo ("Endpoint incorreto") ;
    }


?>