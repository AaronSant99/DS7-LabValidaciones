<?php
session_start();

$errors = [];

// Sanitizar y validar nombre
$name = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
if ($name === "" || !preg_match("/^[a-zA-Z ]*$/", $name)) {
    $errors[] = "Only letters and white space allowed in Name.";
}

// Sanitizar y validar email
$email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
if ($email === "" || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format.";
}

// Sanitizar y validar teléfono (opcional)
$telephone = trim(filter_input(INPUT_POST, 'telephone', FILTER_SANITIZE_STRING));
if ($telephone === "" || !preg_match("/^\d{3}[-\s]?\d{3}[-\s]?\d{4}$/", $telephone)) {
    $errors[] = "Formato de Teléfono inválido. Debe ser por ejemplo: 123-456-7890.";
}

$user_entered_code = $_POST['captcha'] ?? '';
$captcha_code = $_SESSION['captcha_code'] ?? '';
if ($captcha_code === '' || $user_entered_code === '' || $captcha_code !== $user_entered_code) {
    $errors[] = "El código CAPTCHA es incorrecto.";
}

// Mostrar errores o mensaje de éxito
if (!empty($errors)) {
    echo '<div id="errors">';
    foreach ($errors as $error) {
        echo $error . "<br>";
    }
    echo '</div>';
} else {
    // Aquí procesas los datos (ej: guardar en DB)
    echo '<div id="errors" style="color: green;">Form submitted successfully</div>';
}
?>