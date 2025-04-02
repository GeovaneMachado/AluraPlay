<?php

$pdo = new PDO('mysql:host=localhost', 'root', 'root');
$pdo->exec('CREATE DATABASE aluraplay');
$pdo->exec('USE aluraplay');
$pdo->exec('CREATE TABLE videos (id INT AUTO_INCREMENT PRIMARY KEY, title VARCHAR(255), url VARCHAR(255))');
