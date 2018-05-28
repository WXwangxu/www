<?php

$config = [
    'host' => 'localhost',
    'dbname' => 'lx',
    'username' => 'root',
    'password' => 'root',
    ];

\core\model\Model::getConfig($config);

(new \core\model\Model())->getConfig($config);
?>
