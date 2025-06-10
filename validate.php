<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $errors = [];

    // Validar Name
    $name = test_input($_POST["name"] ?? '');
    if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $errors[] = "Solo letras y espacios en blanco permitidos en el nombre.";
    }

    // Validar Email
    $email = test_input($_POST["email"] ?? '');
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Formato de Correo Invalido.";
    }

    // Validar Telephone
    $telephone = test_input($_POST["telephone"] ?? '');
    if (!preg_match("/^\d{3}[-\s]?\d{3}[-\s]?\d{4}$/", $telephone)) {
        $errors[] = "Formato de Teléfono inválido. Debe ser por ejemplo: 123-456-7890.";
    }

    // Validar CAPTCHA
    $user_entered_code = $_POST['captcha'] ?? '';
    $captcha_code = $_SESSION['captcha_code'] ?? '';
    if ($captcha_code === '' || $user_entered_code === '' || $captcha_code !== $user_entered_code) {
        $errors[] = "El código CAPTCHA es incorrecto.";
    }

    // Mostrar errores o éxito en el div correspondiente
    if (!empty($errors)) {
        echo '<div id="errors" style="color: red;">';
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
        echo '</div>';
    } else {
        echo '<div id="errors" style="color: green;">Form submitted successfully</div>';
    }
}

function test_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}
?>