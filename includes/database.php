<?php

$db = mysqli_init();

// Esto es suficiente para que TiDB acepte la conexión segura.
$db->ssl_set(NULL, NULL, NULL, NULL, NULL);

// Esta función permite pasar "flags" adicionales, como MYSQLI_CLIENT_SSL
$db->real_connect(
    $_ENV['DB_HOST'] ?? '',
    $_ENV['DB_USER'] ?? '', 
    $_ENV['DB_PASS'] ?? '', 
    $_ENV['DB_NAME'] ?? '',
    $_ENV['DB_PORT'] ?? 4000,
    NULL, // Socket (no lo usamos)
    MYSQLI_CLIENT_SSL // Fuerza el modo seguro
);

if ($db->connect_errno) {
    echo "Error: No se pudo conectar a MySQL (TiDB).<br>";
    echo "Errno: " . $db->connect_errno . "<br>";
    echo "Error: " . $db->connect_error;
    exit;
}

$db->set_charset("utf8mb4");

return $db;