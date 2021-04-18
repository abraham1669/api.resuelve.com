<?php 
    use Medoo\Medoo;
    if ($_SERVER['HTTP_HOST'] == "localhost") {
        $db = new Medoo([
            'database_type' => 'mysql',
            'database_name' => 'chalaner_api',
            'server' => 'chalaneros.com',
            'username' => 'chalaner_chalaneros',
            'password' => 'Chalaneros.2020!',
            'charset' => 'utf8'
        ]);
    } else {
        $db = new Medoo([
            'database_type' => 'mysql',
            'database_name' => 'chalaner_api',
            'server' => 'localhost',
            'username' => 'chalaner_chalaneros',
            'password' => 'Chalaneros.2020!',
            'charset' => 'utf8'
        ]);
    }