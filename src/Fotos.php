<?php 
require_once 'config.php';

class fotos{

    public static function incluir($dados) {
        $tabela = "fotos";
        $conexao = new PDO(dbDrive . ':host=' . dbEndereco . '; dbname=' . dbNome , dbUsuario , dbSenha);

        $sql = "INSERT INTO $tabela (id_cao, url_foto) VALUES (:id_cao, :url_foto)";
        $stm = $conexao->prepare($sql);

        $stm->bindValue(':id_cao', $dados['id_cao']);
        $stm->bindValue(':url_foto', $dados['url_foto']);

        $stm->execute();
        if($stm->rowCount() > 0){
            return [
                'erro' => false,
                'mensagem' => 'Foto adicionada com sucesso',
                'dados' => [
                    'id' => $conexao->lastInsertId(),
                    'id_cao' => $dados['id_cao'],
                    'url_foto' => $dados['url_foto']
                ]
            ];
        } else {
            return [
                'erro' => true,
                'mensagem' => 'Erro ao adicionar foto',
                'dados' => []
            ];
        }
    }

     public static function alterar($id, $dados) {
        $tabela = "fotos";
        $conexao = new PDO(dbDrive . ':host=' . dbEndereco . '; dbname=' . dbNome , dbUsuario , dbSenha);

        $sql = "UPDATE $tabela SET url_foto=:url_foto WHERE id=:id";
        $stm = $conexao->prepare($sql);

        $stm->bindValue(':id', $id);
        $stm->bindValue(':url_foto', $dados['url_foto']);

        $stm->execute();
        if($stm->rowCount() > 0){
            return [
                'erro' => false,
                'mensagem' => 'Foto alterada com sucesso',
                'dados' => [
                    'id' => $id,
                    'url_foto' => $dados['url_foto']
                ]
            ];
        } else {
            return [
                'erro' => true,
                'mensagem' => 'Foto não encontrada ou não alterada',
                'dados' => []
            ];
        }
    }

    public static function deletar($id) {
        $tabela = "fotos";
        $conexao = new PDO(dbDrive . ':host=' . dbEndereco . '; dbname=' . dbNome , dbUsuario , dbSenha);

        $sql = "DELETE FROM $tabela WHERE id=:id";
        $stm = $conexao->prepare($sql);
        $stm->bindValue(':id', $id);

        $stm->execute();
        if($stm->rowCount() > 0){
            return [
                'erro' => false,
                'mensagem' => 'Foto removida com sucesso',
                'dados' => []
            ];
        } else {
            return [
                'erro' => true,
                'mensagem' => 'Foto não encontrada',
                'dados' => []
            ];
        }
    }
    
public static function selecionar($id) {
        $tabela = "fotos";
        $conexao = new PDO(dbDrive . ':host=' . dbEndereco . ';dbname=' . dbNome, dbUsuario, dbSenha);

        $sql = "SELECT * FROM $tabela WHERE id = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return [
                'erro' => false,
                'mensagem' => 'Foto encontrada',
                'dados' => $stmt->fetch(PDO::FETCH_ASSOC)
            ];
        } else {
            return [
                'erro' => true,
                'mensagem' => 'Foto não encontrada',
                'dados' => []
            ];
        }
    }

    public static function selecionarTodos() {
        $tabela = "fotos";
        $conexao = new PDO(dbDrive . ':host=' . dbEndereco . ';dbname=' . dbNome, dbUsuario, dbSenha);

        $sql = "SELECT * FROM $tabela";
        $stmt = $conexao->query($sql);

        return [
            'erro' => false,
            'mensagem' => 'Lista de fotos',
            'dados' => $stmt->fetchAll(PDO::FETCH_ASSOC)
        ];
    }


}


?>