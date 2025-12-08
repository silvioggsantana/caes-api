<?php
require_once 'config.php';

class Caes {

    private static function conexao() {
        return new PDO(dbDrive . ':host=' . dbEndereco . ';dbname=' . dbNome, dbUsuario, dbSenha);
    }

    private static function listarFotos($idCao) {
        $con = self::conexao();
        $sql = "SELECT url_foto FROM fotos WHERE id_cao = :id";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(':id', $idCao);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public static function selecionar($id) {
        $tabela = "caes";
        $conexao = self::conexao();

        $sql = "SELECT * FROM $tabela WHERE id = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $cao = $stmt->fetch(PDO::FETCH_ASSOC);
            $cao["fotos"] = self::listarFotos($id);

            return [
                'erro' => false,
                'mensagem' => 'Cão encontrado',
                'dados' => $cao
            ];
        } else {
            return [
                'erro' => true,
                'mensagem' => 'Cão não encontrado',
                'dados' => []
            ];
        }
    }

    public static function selecionarTodos() {
        $tabela = "caes";
        $conexao = self::conexao();

        $sql = "SELECT * FROM $tabela";
        $stmt = $conexao->query($sql);
        $caes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // adicionando fotos para cada cachorro
        foreach ($caes as &$cao) {
            $cao["fotos"] = self::listarFotos($cao["id"]);
        }

        return [
            'erro' => false,
            'mensagem' => 'Lista de cães',
            'dados' => $caes
        ];
    }

    // restante permanece igual...
    public static function incluir($dados) {
        $tabela = "caes";

        $conexao = self::conexao();
        $sql = "INSERT INTO $tabela (nome, idade, descricao, porte, sexo, id_usuario) 
        VALUES (:nome, :idade, :descricao, :porte, :sexo, :id_usuario)";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':nome', $dados['nome']);
        $stmt->bindValue(':idade', $dados['idade']);
        $stmt->bindValue(':descricao', $dados['descricao']);
        $stmt->bindValue(':porte', $dados['porte']);
        $stmt->bindValue(':sexo', $dados['sexo']);
        $stmt->bindValue(':id_usuario', $dados['id_usuario']);
        $stmt->execute();

        return [
            'erro' => false,
            'mensagem' => 'Cão cadastrado',
            'dados' => ['id' => $conexao->lastInsertId()]
        ];
    }

    public static function alterar($id, $dados) {
        $tabela = "caes";

        $conexao = self::conexao();
        $sql = "UPDATE $tabela SET nome = :nome, idade = :idade, descricao = :descricao, porte = :porte, sexo = :sexo WHERE id = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':nome', $dados['nome']);
        $stmt->bindValue(':idade', $dados['idade']);
        $stmt->bindValue(':descricao', $dados['descricao']);
        $stmt->bindValue(':porte', $dados['porte']);
        $stmt->bindValue(':sexo', $dados['sexo']);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        return [
            'erro' => false,
            'mensagem' => 'Cão atualizado',
            'dados' => ['id' => $id]
        ];
    }

    public static function deletar($id) {
        $tabela = "caes";
        $conexao = self::conexao();
        $sql = "DELETE FROM caes WHERE id = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        return [
            'erro' => false,
            'mensagem' => 'Cão deletado',
            'dados' => []
        ];
    }
}
?>
