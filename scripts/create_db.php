<?php
// Simple helper to create database from .env
$env = @file(__DIR__ . '/../.env');
$host = '127.0.0.1';
$port = '3306';
$user = 'root';
$pass = '';
$db = 'laravel';
if ($env) {
    foreach ($env as $line) {
        if (preg_match('/^DB_HOST=(.*)/', $line, $m)) $host = trim(trim($m[1], "\"'"));
        if (preg_match('/^DB_PORT=(.*)/', $line, $m)) $port = trim(trim($m[1], "\"'"));
        if (preg_match('/^DB_USERNAME=(.*)/', $line, $m)) $user = trim(trim($m[1], "\"'"));
        if (preg_match('/^DB_PASSWORD=(.*)/', $line, $m)) $pass = trim(trim($m[1], "\"'"));
        if (preg_match('/^DB_DATABASE=(.*)/', $line, $m)) $db = trim(trim($m[1], "\"'"));
    }
}
if (empty($port)) $port = '3306';
try {
    $dsn = "mysql:host={$host};port={$port}";
    $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $safeDb = str_replace('`', '', $db);
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `" . $safeDb . "` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    echo "Database '{$safeDb}' created or already exists.\n";
    exit(0);
} catch (PDOException $e) {
    fwrite(STDERR, "Failed to create database: " . $e->getMessage() . PHP_EOL);
    exit(1);
}
