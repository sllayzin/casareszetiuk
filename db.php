<?php
declare(strict_types=1);

$host = '127.0.0.1';
$database = 'reszetiuk';
$username = 'root';
$password = ''; // No XAMPP local, costuma ficar vazio se você não definiu uma senha.

try {
    $pdo = new PDO(
        "mysql:host={$host};dbname={$database};charset=utf8mb4",
        $username,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
} catch (PDOException $exception) {
    http_response_code(500);
    exit('Não foi possível conectar ao banco. Confira se o MySQL está iniciado e os dados em db.php estão corretos.');
}
