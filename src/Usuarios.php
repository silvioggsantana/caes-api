<?php
require_once 'config.php';

class Usuarios {

    public static function buscarPeloCodigo($id) {
        $tabela = "usuarios";
        $conexao = new PDO(dbDrive . ':host=' . dbEndereco . '; dbname=' . dbNome , dbUsuario , dbSenha);

        $sql = "SELECT * FROM $tabela WHERE id = :id";
        $stm = $conexao->prepare($sql);
        $stm->bindValue(':id', $id);

        $stm->execute();
        if($stm->rowCount() > 0){
            $dados = $stm->fetch(PDO::FETCH_ASSOC);
            return [
                'erro' => false,
                'mensagem' => 'Dados encontrados',
                'dados' => $dados
            ];
        } else {
            return [
                'erro' => true,
                'mensagem' => 'Usuário não encontrado',
                'dados' => []
            ];
        }
    }

    public static function buscarTodos() {
        $tabela = "usuarios";
        $conexao = new PDO(dbDrive . ':host=' . dbEndereco . '; dbname=' . dbNome , dbUsuario , dbSenha);

        $sql = "SELECT * FROM $tabela";
        $stm = $conexao->prepare($sql);
        $stm->execute();

        if($stm->rowCount() > 0){
            $dados = $stm->fetchAll(PDO::FETCH_ASSOC);
            return [
                'erro' => false,
                'mensagem' => 'Dados encontrados',
                'dados' => $dados
            ];
        } else {
            return [
                'erro' => true,
                'mensagem' => 'Tabela vazia',
                'dados' => []
            ];
        }
    }

    public static function incluir($dados) {
        $tabela = "usuarios";
        $conexao = new PDO(dbDrive . ':host=' . dbEndereco . '; dbname=' . dbNome , dbUsuario , dbSenha);

        $sql = "INSERT INTO $tabela (nome, email, senha, telefone, tipo) 
                VALUES (:nome, :email, :senha, :telefone, :tipo)";
        $stm = $conexao->prepare($sql);

        $stm->bindValue(':nome', $dados['nome']);
        $stm->bindValue(':email', $dados['email']);
        $stm->bindValue(':senha', $dados['senha']);
        $stm->bindValue(':telefone', $dados['telefone']);
        $stm->bindValue(':tipo', $dados['tipo']);

        $stm->execute();
        if($stm->rowCount() > 0){
            return [
                'erro' => false,
                'mensagem' => 'Usuário cadastrado com sucesso',
                'dados' => []
            ];
        } else {
            return [
                'erro' => true,
                'mensagem' => 'Erro ao cadastrar usuário',
                'dados' => []
            ];
        }
    }

    public static function alterar($id, $dados) {
        $tabela = "usuarios";
        $conexao = new PDO(dbDrive . ':host=' . dbEndereco . '; dbname=' . dbNome , dbUsuario , dbSenha);

        $sql = "UPDATE $tabela 
                SET nome=:nome, email=:email, senha=:senha, telefone=:telefone, tipo=:tipo 
                WHERE id=:id";
        $stm = $conexao->prepare($sql);

        $stm->bindValue(':id', $id);
        $stm->bindValue(':nome', $dados['nome']);
        $stm->bindValue(':email', $dados['email']);
        $stm->bindValue(':senha', $dados['senha']);
        $stm->bindValue(':telefone', $dados['telefone']);
        $stm->bindValue(':tipo', $dados['tipo']);

        $stm->execute();
        if($stm->rowCount() > 0){
            return [
                'erro' => false,
                'mensagem' => 'Usuário alterado com sucesso',
                'dados' => []
            ];
        } else {
            return [
                'erro' => true,
                'mensagem' => 'Erro ao alterar usuário',
                'dados' => []
            ];
        }
    }

    public static function deletar($id) {
        $tabela = "usuarios";
        $conexao = new PDO(dbDrive . ':host=' . dbEndereco . '; dbname=' . dbNome , dbUsuario , dbSenha);

        $sql = "DELETE FROM $tabela WHERE id=:id";
        $stm = $conexao->prepare($sql);
        $stm->bindValue(':id', $id);

        $stm->execute();
        if($stm->rowCount() > 0){
            return [
                'erro' => false,
                'mensagem' => 'Usuário excluído com sucesso',
                'dados' => []
            ];
        } else {
            return [
                'erro' => true,
                'mensagem' => 'Usuário não encontrado',
                'dados' => []
            ];
        }
    }
}
?>
