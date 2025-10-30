<?php
require_once 'Caes.php';

class CaesService {

    public function GET($id = null) {
        if ($id) {
            return Caes::selecionar($id);
        } else {
            return Caes::selecionarTodos();
        }
    }

    public function POST() {
    $dados = json_decode(file_get_contents("php://input"), true);

    if(!$dados || !isset($dados['nome']) || 
       !isset($dados['idade']) || !isset($dados['descricao']) || 
       !isset($dados['porte']) || !isset($dados['id_usuario'])) {
        return [
            'erro' => true,
            'mensagem' => 'Parâmetros inválidos para cadastro do cão',
            'dados' => []
        ];
    }

    return Caes::incluir($dados);
}

public function PUT($id = null) {
    if(!$id) {
        return [
            'erro' => true,
            'mensagem' => 'ID do cão não informado',
            'dados' => []
        ];
    }

    $dados = json_decode(file_get_contents("php://input"), true);
    if(!$dados || !isset($dados['nome']) || 
       !isset($dados['idade']) || !isset($dados['descricao']) || 
       !isset($dados['porte'])) {
        return [
            'erro' => true,
            'mensagem' => 'Parâmetros inválidos para alteração do cão',
            'dados' => []
        ];
    }

    return Caes::alterar($id, $dados);
}




    public function DELETE($id = null) {
        if(!$id) {
            return [
                'erro' => true,
                'mensagem' => 'ID do cão não informado',
                'dados' => []
            ];
        }

        return Caes::deletar($id);
    }
}
?>
