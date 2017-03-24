<?php

if (YII_ENV_DEV) {
    $dns = 'mysql:host=127.0.0.1;dbname=gibiteca';
    $username = 'root';
    $password = '';
} else {
    list($dns, $username, $password) = explode('|', file_get_contents(__DIR__ . '/db.config'));
}

return [
    'class' => 'yii\db\Connection',
    'dsn' => $dns,
    'username' => $username, 
    'password' => $password,
    'charset' => 'utf8',
];