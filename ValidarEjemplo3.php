<!DOCTYPE html>
<html>
<head>
    <title>Validaciones con Fetch</title>
    <link rel="stylesheet" href="styles.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="wrapper">
        <form id="contactForm" action="validate.php" method="post">
            <h1>Ejemplo de Validaciones</h1>

            <div class="input-box">
                <div class="input-field">
                    <input type="text" placeholder="Nombre Completo "name="name" required>
                    <i class='bx bxs-user' ></i>
                </div>
            </div>

            <div class="input-box">
                <div class="input-field">
                    <input type="text" placeholder="Correo "name="email" required>
                    <i class='bx bxs-envelope' ></i>
                </div>
            </div>
            
            <div class="input-box">
                <div class="input-field">
                    <input type="text" placeholder="Telefono "name="telephone" required>
                    <i class='bx bxs-phone' ></i>
                </div>
            </div>

            <!-- CAPTCHA -->
            <img src="captcha.php" alt="CAPTCHA Image"><br><br>

            <div class="input-box">
                <div class="input-field">
                    <label>Introduce el código mostrado: </label>
                    <input type="text" name="captcha" required>
                </div>
            </div>
            
            <button type="submit" class="btn">Registrar</button>
        </form>
        <div id="response"></div>
        <div id="errors"></div>
    </div>    

<script src="form-handler.js" defer></script>
</body>
</html>