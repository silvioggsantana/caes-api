<?php
require_once 'Adocoes.php';

class AdocoesService {

    public function GET($id = null) {
        if ($id) {
            return Adocoes::selecionar($id);
        } else {
            return Adocoes::selecionarTodos();
        }
    }

    public function POST() {
        $dados = json_decode(file_get_contents("php://input"), true);

        if(!$dados || !isset($dados['id_usuario']) || 
           !isset($dados['id_cao']) || !isset($dados['data_adocao']) ||
           !isset($dados['descricao'])) {
            return [
                'erro' => true,
                'mensagem' => 'Parâmetros inválidos para cadastro da adoção',
                'dados' => []
            ];
        }

        return Adocoes::incluir($dados);
    }

    public function PUT($id = null) {
        if(!$id) {
            return [
                'erro' => true,
                'mensagem' => 'ID da adoção não informado',
                'dados' => []
            ];
        }

        $dados = json_decode(file_get_contents("php://input"), true);
        if(!$dados || !isset($dados['id_usuario']) || 
           !isset($dados['id_cao']) || !isset($dados['data_adocao']) ||
           !isset($dados['descricao'])) {
            return [
                'erro' => true,
                'mensagem' => 'Parâmetros inválidos para alteração da adoção',
                'dados' => []
            ];
        }

        return Adocoes::alterar($id, $dados);
    }

    public function DELETE($id = null) {
        if(!$id) {
            return [
                'erro' => true,
                'mensagem' => 'ID da adoção não informado',
                'dados' => []
            ];
        }

        return Adocoes::deletar($id);
    }
}
?>
