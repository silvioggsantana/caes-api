<?php
require_once 'config.php';

class Adocoes {

    public static function selecionar($id) {
        $tabela = "adocoes";
        $conexao = new PDO(dbDrive . ':host=' . dbEndereco . ';dbname=' . dbNome, dbUsuario, dbSenha);

        $sql = "SELECT * FROM $tabela WHERE id = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return [
                'erro' => false,
                'mensagem' => 'Adoção encontrada',
                'dados' => $stmt->fetch(PDO::FETCH_ASSOC)
            ];
        } else {
            return [
                'erro' => true,
                'mensagem' => 'Adoção não encontrada',
                'dados' => []
            ];
        }
    }

    public static function selecionarTodos() {
        $tabela = "adocoes";
        $conexao = new PDO(dbDrive . ':host=' . dbEndereco . ';dbname=' . dbNome, dbUsuario, dbSenha);

        $sql = "SELECT * FROM $tabela";
        $stmt = $conexao->query($sql);

        return [
            'erro' => false,
            'mensagem' => 'Lista de adoções',
            'dados' => $stmt->fetchAll(PDO::FETCH_ASSOC)
        ];
    }

    public static function incluir($dados) {
        $tabela = "adocoes";
        $conexao = new PDO(dbDrive . ':host=' . dbEndereco . ';dbname=' . dbNome, dbUsuario, dbSenha);

        $sql = "INSERT INTO $tabela (id_usuario, id_cao, data_adocao, descricao) 
                VALUES (:id_usuario, :id_cao, :data_adocao, :descricao)";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id_usuario', $dados['id_usuario']);
        $stmt->bindValue(':id_cao', $dados['id_cao']);
        $stmt->bindValue(':data_adocao', $dados['data_adocao']);
        $stmt->bindValue(':descricao', $dados['descricao']);
        $stmt->execute();

        return [
            'erro' => false,
            'mensagem' => 'Adoção cadastrada com sucesso',
            'dados' => [
                'id' => $conexao->lastInsertId(),
                'id_usuario' => $dados['id_usuario'],
                'id_cao' => $dados['id_cao'],
                'data_adocao' => $dados['data_adocao'],
                'descricao' => $dados['descricao']
            ]
        ];
    }

    public static function alterar($id, $dados) {
        $tabela = "adocoes";
        $conexao = new PDO(dbDrive . ':host=' . dbEndereco . ';dbname=' . dbNome, dbUsuario, dbSenha);

        $sql = "UPDATE $tabela 
                   SET id_usuario = :id_usuario, id_cao = :id_cao, data_adocao = :data_adocao, descricao = :descricao 
                 WHERE id = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id_usuario', $dados['id_usuario']);
        $stmt->bindValue(':id_cao', $dados['id_cao']);
        $stmt->bindValue(':data_adocao', $dados['data_adocao']);
        $stmt->bindValue(':descricao', $dados['descricao']);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        return [
            'erro' => false,
            'mensagem' => 'Adoção atualizada com sucesso',
            'dados' => [
                'id' => $id,
                'id_usuario' => $dados['id_usuario'],
                'id_cao' => $dados['id_cao'],
                'data_adocao' => $dados['data_adocao'],
                'descricao' => $dados['descricao']
            ]
        ];
    }

    public static function deletar($id) {
        $tabela = "adocoes";
        $conexao = new PDO(dbDrive . ':host=' . dbEndereco . ';dbname=' . dbNome, dbUsuario, dbSenha);

        $sql = "DELETE FROM $tabela WHERE id = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        return [
            'erro' => false,
            'mensagem' => 'Adoção deletada com sucesso',
            'dados' => []
        ];
    }
}
?>
