<?php
session_start();

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $errors = [];

    // Validar Nombre
    $name = test_input($_POST["name"] ?? '');
    if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $errors[] = "Solo letras y espacios en blanco permitidos en el nombre.";
    }

    // Validar Email
    $email = test_input($_POST["email"] ?? '');
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Formato de Correo Inválido.";
    }

    // Validar Teléfono
    $telephone = test_input($_POST["telephone"] ?? '');
    if (!preg_match("/^\d{3}-\d{3}-\d{4}$/", $telephone)) {
        $errors[] = "Formato de Teléfono inválido. Ejemplo de Formato Valido: 123-456-7890.";
    }

    // Validar CAPTCHA
    $user_entered_code = $_POST['captcha'] ?? '';
    $captcha_code = $_SESSION['captcha_code'] ?? '';
    if ($captcha_code === '' || $user_entered_code === '' || $captcha_code !== $user_entered_code) {
        $errors[] = "El código CAPTCHA es incorrecto.";
    }

    if (!empty($errors)) {
        echo json_encode(['success' => false, 'errors' => $errors]);
    } else {
        echo json_encode(['success' => true]);
    }
    exit;
}

function test_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}
?>