<?php
namespace DB\Models;

class PessoaModel {
    private $codigo;
    private $nome;
    private $telefone;
    private $estado;
    private $cidade;
    private $bairro;
    private $email;
    private $senha;
    private $ativo;

    public function __construct($nome, $telefone, $estado, $cidade, $bairro, $email, $senha, $ativo){
        $this->setNome($nome);
        $this->setTelefone($telefone);
        $this->setEstado($estado);
        $this->setCidade($cidade);
        $this->setBairro($bairro);
        $this->setEmail($email);
        $this->setSenha($senha);
        $this->setAtivo($ativo);
    }
    
    public function getCodigo(){
        return $this->codigo;
    }

    public function setCodigo($codigo){
        $this->codigo = $codigo;
        return $this;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setNome($nome){
        $this->nome = $nome;
        return $this;
    }
 
    public function getTelefone(){
        return $this->telefone;
    }

    public function setTelefone($telefone){
        $this->telefone = $telefone;
        return $this;
    }

    public function getEstado(){
        return $this->estado;
    }

    public function setEstado($estado){
        $this->estado = $estado;
        return $this;
    }

    public function getCidade(){
        return $this->cidade;
    }

    public function setCidade($cidade){
        $this->cidade = $cidade;
        return $this;
    }

    public function getBairro(){
        return $this->bairro;
    }
 
    public function setBairro($bairro){
        $this->bairro = $bairro;
        return $this;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
        return $this;
    }

    public function getSenha(){
        return $this->senha;
    }

    public function setSenha($senha){
        $this->senha = $senha;
        return $this;
    }

    public function getAtivo(){
        return $this->ativo;
    }

    public function setAtivo($ativo){
        $this->ativo = $ativo;
        return $this;
    }
}