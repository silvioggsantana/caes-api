<?php
require_once 'config.php';

class Caes {

    public static function selecionar($id) {
        $tabela = "caes";
        $conexao = new PDO(dbDrive . ':host=' . dbEndereco . ';dbname=' . dbNome, dbUsuario, dbSenha);

        $sql = "SELECT * FROM $tabela WHERE id = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return [
                'erro' => false,
                'mensagem' => 'Cão encontrado',
                'dados' => $stmt->fetch(PDO::FETCH_ASSOC)
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
        $conexao = new PDO(dbDrive . ':host=' . dbEndereco . ';dbname=' . dbNome, dbUsuario, dbSenha);

        $sql = "SELECT * FROM $tabela";
        $stmt = $conexao->query($sql);

        return [
            'erro' => false,
            'mensagem' => 'Lista de cães',
            'dados' => $stmt->fetchAll(PDO::FETCH_ASSOC)
        ];
    }

    public static function incluir($dados) {
    $tabela = "caes";
    $conexao = new PDO(dbDrive . ':host=' . dbEndereco . ';dbname=' . dbNome, dbUsuario, dbSenha);

    $sql = "INSERT INTO $tabela (nome,  idade, descricao, porte, id_usuario) 
            VALUES (:nome, :idade, :descricao, :porte, :id_usuario)";
    $stmt = $conexao->prepare($sql);
    $stmt->bindValue(':nome', $dados['nome']);
    $stmt->bindValue(':idade', $dados['idade']);
    $stmt->bindValue(':descricao', $dados['descricao']);
    $stmt->bindValue(':porte', $dados['porte']);
    $stmt->bindValue(':id_usuario', $dados['id_usuario']);
    $stmt->execute();

    return [
        'erro' => false,
        'mensagem' => 'Cão cadastrado com sucesso',
        'dados' => [
            'id' => $conexao->lastInsertId(),
            'nome' => $dados['nome'],
            'idade' => $dados['idade'],
            'descricao' => $dados['descricao'],
            'porte' => $dados['porte'],
            'id_usuario' => $dados['id_usuario']
        ]
    ];
}

public static function alterar($id, $dados) {
    $tabela = "caes";
    $conexao = new PDO(dbDrive . ':host=' . dbEndereco . ';dbname=' . dbNome, dbUsuario, dbSenha);

    $sql = "UPDATE $tabela SET nome = :nome, idade = :idade, descricao = :descricao, porte = :porte WHERE id = :id";
    $stmt = $conexao->prepare($sql);
    $stmt->bindValue(':nome', $dados['nome']);
    $stmt->bindValue(':idade', $dados['idade']);
    $stmt->bindValue(':descricao', $dados['descricao']);
    $stmt->bindValue(':porte', $dados['porte']);
    $stmt->bindValue(':id', $id);
    $stmt->execute();

    return [
        'erro' => false,
        'mensagem' => 'Cão atualizado com sucesso',
        'dados' => [
            'id' => $id,
            'nome' => $dados['nome'],
            'idade' => $dados['idade'],
            'descricao' => $dados['descricao'],
            'porte' => $dados['porte']
        ]
    ];
}

    public static function deletar($id) {
        $tabela = "caes";
        $conexao = new PDO(dbDrive . ':host=' . dbEndereco . ';dbname=' . dbNome, dbUsuario, dbSenha);

        $sql = "DELETE FROM $tabela WHERE id = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        return [
            'erro' => false,
            'mensagem' => 'Cão deletado com sucesso',
            'dados' => []
        ];
    }
}
?>
