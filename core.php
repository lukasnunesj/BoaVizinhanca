<?php

require_once "vendor/autoload.php";

use App\DB\DAO\PessoaDAO;
use App\DB\Models\PessoaModel;
use App\DB\MySQL\MySQLConexao;

$acao = isset($_POST['acao']) ? $_POST['acao'] : null;
$nome = isset($_POST['nome']) ? $_POST['nome'] : null;
$tefone = isset($_POST['telefone']) ? $_POST['telefone'] : null;
$estado = isset($_POST['estado']) ? $_POST['estado'] : null;
$cidade = isset($_POST['cidade']) ? $_POST['cidade'] : null;
$bairro = isset($_POST['bairro']) ? $_POST['bairro'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;
$senha = isset($_POST['senha']) ? $_POST['senha'] : null;
$codigo = isset($_POST['codigo']) ? $_POST['codigo'] : null;

$cliente = new MySQLConexao;

switch ($acao) {
    case 'cadastrar':
        try{
            $pessoa_obj = new PessoaModel($nome, $tefone, $estado, $cidade, $bairro, $email, $senha, true);
            $pessoa_dao = new PessoaDAO($cliente);
            $codigo = $pessoa_dao->criar($pessoa_obj);
            
            echo json_encode([
                "sucesso" => true,
                "codigo" => $codigo
            ]);
        } catch (Error $erro){
            echo json_encode([ 
                "sucesso" => false,
                'msg' => $erro->getMessage()
            ]);
        }

        break;
        case 'atualizar':
            try{
                $pessoa_obj = new PessoaModel($nome, $tefone, $estado, $cidade, $bairro, $email, $senha, true);
                $pessoa_obj->setCodigo($codigo);
                $pessoa_dao = new PessoaDAO($cliente);
                $dados = $pessoa_dao->atualizar($pessoa_obj);
                
                echo json_encode([
                    "sucesso" => true,
                    "msg" => 'Dados atualizados'
                ]);
            } catch (Error $erro){
                echo json_encode([ 
                    "sucesso" => false,
                    'msg' => $erro->getMessage()
                ]);
            }
    
            break;
    case 'buscar':
        try{
            $pessoa_dao = new PessoaDAO($cliente);
            $dados = $pessoa_dao->selecionar($bairro, $cidade, $estado);
            
            echo json_encode([
                "sucesso" => true,
                "dados" => $dados
            ]);
        } catch (Error $erro){
            echo json_encode([ 
                "sucesso" => false,
                'msg' => $erro->getMessage()
            ]);
        }
        break;
    case 'logar':
        try{
            $pessoa_dao = new PessoaDAO($cliente);
            $dados = $pessoa_dao->logar($email, $senha);

            if(sizeof($dados) <= 0){
                echo json_encode([
                    "sucesso" => false,
                    "msg" => "Senha ou email invalidos"
                ]);
            }
            
            echo json_encode([
                "sucesso" => true,
                "dados" => $dados
            ]);
        } catch (Error $erro){
            echo json_encode([ 
                "sucesso" => false,
                'msg' => $erro->getMessage()
            ]);
        }
        break;

    case 'excluir' :
        try{
            $pessoa_dao = new PessoaDAO($cliente);
            $dados = $pessoa_dao->excluir($codigo);

            echo json_encode([
                "sucesso" => true,
                "msg" => "Excluido com sucesso"
            ]);
        } catch (Error $erro){
            echo json_encode([ 
                "sucesso" => false,
                'msg' => $erro->getMessage()
            ]);
        }
        break;
    break;
    

}
