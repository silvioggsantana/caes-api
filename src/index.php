<?php

    include_once 'AdocoesService.php' ;
    include_once 'CaesService.php' ;
    include_once 'UsuariosService.php' ;
    include_once 'FotosService.php' ;
    include_once 'util.php' ;



    if( @$_GET['url'] ) {
        $url = explode( '/' , $_GET['url'] )  ;



        if( $url[0]  === 'api'  ) {
            array_shift( $url ) ;
            $service =  ucfirst($url[0] ) . "Service"  ;  
            $method = $_SERVER["REQUEST_METHOD"] ;
            

            array_shift( $url ) ;
            try {

                $response = call_user_func_array( array( new $service , $method ) ,  $url    ) ;
                http_response_code(200) ;

                echo FormatarMensagemJson( $response["erro"] , $response["mensagem"] , $response["dados"]  ) ;

            }
            catch ( Exception $erro ) {
                http_response_code(500) ;

                echo FormatarMensagemJson( true , $erro->getMessage() , [] ) ;
            }


        } else {
            echo ("Endpoint incorreto") ;
        }
    } else {
        echo ("Endpoint incorreto") ;
    }


?>