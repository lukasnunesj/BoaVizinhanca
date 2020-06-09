<?php

require_once "vendor/autoload.php";

use DB\DAO\PessoaDAO;
use DB\Models\PessoaModel;
use DB\MySQL\MySQLConexao;

$cliente = new MySQLConexao;

$pessoa_obj = new PessoaModel('jose', '123123', 1, 1, 1, 'teste', 'teste', true);
$pessoa_dao = new PessoaDAO($cliente);

$pessoa_dao->criar($pessoa_obj);


