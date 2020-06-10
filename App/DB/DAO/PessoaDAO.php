<?php

namespace App\DB\DAO;

use PDO;
use App\DB\Models\PessoaModel;
use App\DB\Interfaces\ConexaoInterface;
use PDOException;

class PessoaDAO {
    private $conexao;
    
    public function __construct(ConexaoInterface $clientConexao){
        $this->conexao = $clientConexao->connect();
    }

    public function criar(PessoaModel $pessoa){
        $sql = "
            INSERT INTO pessoas
                (nome, telefone, estado, cidade, bairro, email, senha)
            VALUES
                (?, ?, ?, ?, ?, ?, ?);
        ";
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(1, $pessoa->getNome(), PDO::PARAM_STR);
            $consulta->bindValue(2, $pessoa->getTelefone());
            $consulta->bindValue(3, $pessoa->getEstado());
            $consulta->bindValue(4, $pessoa->getCidade());
            $consulta->bindValue(5, $pessoa->getBairro());
            $consulta->bindValue(6, $pessoa->getEmail(), PDO::PARAM_STR);
            $consulta->bindValue(7, $pessoa->getSenha());

            $consulta->execute();
            $codigo = $this->conexao->lastInsertId();

            return $codigo;

        } catch (PDOException $exception) {
            die("Erro: <code>" . $exception->getMessage() . "</code>");
            return false;
        }
    }

    public function selecionar($bairro, $cidade, $estado){
        $where = '';
        $valores = [];

        if(!empty($bairro)){
            $where .= " AND bairro like ? ";
            array_push($valores,"%$bairro%");
        }
        if(!empty($cidade)){
            $where .= " AND cidade like ? ";
            array_push($valores, "%$cidade%");
        }
        if(!empty($estado)){
            $where .= " AND estado = ? ";
            array_push($valores, $estado);
        }

        $sql = "
            SELECT nome, telefone, estado, cidade, bairro, email
            FROM pessoas
            WHERE
                true
                $where
        ";
        
        $consulta = $this->conexao->prepare($sql);
        $consulta->execute($valores);
        $results = $consulta->fetchAll(PDO::FETCH_OBJ);
        
        return $results;    
        
    }
    
}