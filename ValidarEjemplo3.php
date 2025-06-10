<!DOCTYPE html>
<html>
<head>
    <title>Validaciones con Fetch</title>
</head>
<body>

<h2>Ejemplo de Validaciones</h2>
<form id="contactForm" action="validate.php" method="post">
    Name: <input type="text" name="name"><br><br>
    Email: <input type="text" name="email"><br><br>
    Telephone: <input type="text" name="telephone"><br><br>
    <!-- CAPTCHA -->
    <img src="captcha.php" alt="CAPTCHA Image"><br>
    Introduce el código mostrado: <input type="text" name="captcha" required><br><br>
    <input type="submit" name="submit" value="Submit">
</form>
<div id="response"></div>
<div id="errors"></div>
<script src="form-handler.js" defer></script>
</body>
</html>