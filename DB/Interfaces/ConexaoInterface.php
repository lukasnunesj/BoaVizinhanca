<?php
namespace DB\Interfaces;

interface ConexaoInterface {
    public static function connect();
    public static function disconnect();

}