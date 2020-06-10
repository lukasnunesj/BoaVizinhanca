<?php
namespace App\DB\Interfaces;

interface ConexaoInterface {
    public static function connect();
    public static function disconnect();

}