<?php 
    use Medoo\Medoo;
    if ($_SERVER['HTTP_HOST'] == "localhost") {
        $db = new Medoo([
            'database_type' => 'mysql',
            'database_name' => 'u602339566_api',
            'server' => 'internet-rv.com.mx',
            'username' => 'u602339566_api',
            'password' => '[4PbAs0g8Ut',
            'charset' => 'utf8'
        ]);
    } else {
        $db = new Medoo([
            'database_type' => 'mysql',
            'database_name' => 'u602339566_api',
            'server' => 'localhost',
            'username' => 'u602339566_api',
            'password' => '[4PbAs0g8Ut',
            'charset' => 'utf8'
        ]);
    }