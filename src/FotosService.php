<?php
require_once 'Fotos.php';

class FotosService {

    public function GET($id = null) {
        if ($id) {
            return Fotos::selecionar($id);
        } else {
            return Fotos::selecionarTodos();
        }
    }

    public function POST() {
        $dados = json_decode(file_get_contents("php://input"), true);

        if(!$dados || !isset($dados['id_cao']) || !isset($dados['url_foto'])) {
            return [
                'erro' => true,
                'mensagem' => 'Parâmetros inválidos para cadastro da foto',
                'dados' => []
            ];
        }

        return Fotos::incluir($dados);
    }

    public function PUT($id = null) {
        if(!$id) {
            return [
                'erro' => true,
                'mensagem' => 'ID da foto não informado',
                'dados' => []
            ];
        }

        $dados = json_decode(file_get_contents("php://input"), true);
        if(!$dados || !isset($dados['url_foto'])) {
            return [
                'erro' => true,
                'mensagem' => 'Parâmetros inválidos para alteração da foto',
                'dados' => []
            ];
        }

        return Fotos::alterar($id, $dados);
    }

    public function DELETE($id = null) {
        if(!$id) {
            return [
                'erro' => true,
                'mensagem' => 'ID da foto não informado',
                'dados' => []
            ];
        }

        return Fotos::deletar($id);
    }
}
?>
