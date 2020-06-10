<?php

namespace App\DB\MySQL;

use App\DB\Interfaces\ConexaoInterface;
use PDO, PDOException;

class MySQLConexao implements ConexaoInterface {


    public function __destruct() {
        $this->disconnect();
        foreach ($this as $key => $value) {
            unset($this->$key);
        }
    }
    
    private static $host        = "localhost";
    private static $port        = "3306";
    private static $user        = "root";
    private static $password    = "root";
    private static $db          = "boavizinhanca";
    private static $conexao;

    public static function connect() {
        if (!isset(self::$conexao)){
            try {
                self::$conexao = new PDO("mysql:host=".self::$host.";port=".self::$port.";dbname=".self::$db, self::$user, self::$password);
            } catch (PDOException $exception) {
                die("Erro: <code>" . $exception->getMessage() . "</code>");
            }
        }
        return self::$conexao;
    }

    public static function disconnect(){
        self::$conexao = null;
    }
}