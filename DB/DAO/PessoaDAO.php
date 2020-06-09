<?php

namespace DB\DAO;

use PDO;
use DB\Models\PessoaModel;
use DB\Interfaces\ConexaoInterface;
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
        } catch (PDOException $exception) {
            die("Erro: <code>" . $exception->getMessage() . "</code>");
        }
    }

    public function atualizar(PessoaModel $pessoa){
    }

    public function selecionar(){

    }

    public function deletar(PessoaModel $pessoa){

    }
    
}