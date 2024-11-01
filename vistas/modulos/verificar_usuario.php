<?php
// Conexión a la base de datos
$pdo = new PDO("mysql:host=localhost;consuloriodental3.sql=nombre", "usuario", "password");

// Verificar si se envió el nombre de usuario
if (isset($_GET['usuario'])) {
    $usuario = $_GET['usuario'];

    // Consulta para verificar si el nombre de usuario ya existe
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM usuario WHERE nombre = :usuario");
    $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
    $stmt->execute();

    // Obtener el resultado (0 o 1)
    $existe = $stmt->fetchColumn();

    // Retornar la respuesta en formato JSON
    echo json_encode(['existe' => $existe > 0]);
}
?>
