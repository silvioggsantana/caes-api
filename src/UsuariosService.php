<?php
include_once 'Usuarios.php';

class UsuariosService {
    
    public function get($id = null){
        if($id) {
            return Usuarios::buscarPeloCodigo($id);
        } else {
            return Usuarios::buscarTodos();
        }
    }

    public function post() {
        $dados = json_decode(file_get_contents('php://input'), true, 512);
        if($dados == null) {
            throw new Exception("Faltam dados para incluir.");
        }
        return Usuarios::incluir($dados);
    }

    public function put($id = null) {
        if($id == null) {
            throw new Exception("Falta o código do usuário.");
        }
        $dados = json_decode(file_get_contents('php://input'), true, 512);
        if($dados == null) {
            throw new Exception("Faltam dados para alterar.");
        }
        return Usuarios::alterar($id, $dados);
    }

    public function delete($id = null) {
        if($id == null) {
            throw new Exception("Falta o código do usuário.");
        }
        return Usuarios::deletar($id);
    }
}
?>
