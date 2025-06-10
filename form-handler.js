document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contactForm');
    form.addEventListener('submit', async function(event) {
        event.preventDefault();

        let errorMsg = "";

        // Validación cliente de nombre (opcional)
        const nombre = form.name.value.trim();
        if (nombre === "" || !/^[a-zA-Z ]+$/.test(nombre)) {
            errorMsg += "Solo letras y espacios en blanco permitidos en el nombre.<br>";
        }

        const email = form.email.value.trim();
        if (email === "" || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            errorMsg += "Formato de Correo Invalido.<br>";
        }

        const telefono = form.telephone.value.trim();
        const telefonoRegex = /^\d{3}-\d{3}-\d{4}$/;
        if (!telefonoRegex.test(telefono)) {
            errorMsg += "Formato de Teléfono inválido. Ejemplo de Formato Valido: 123-456-7890.<br>";
        }

        const captcha = form.captcha.value.trim();
        if (captcha === "") {
            errorMsg += "El código CAPTCHA es obligatorio.<br>";
        }

        if (errorMsg) {
            document.getElementById('errors').innerHTML = errorMsg;
            return;
        }
        // Si no hay errores, enviar el formulario
        const formData = new FormData(form);
        const response = await fetch(form.action, {
            method: form.method,
            body: formData,
        });
        const result = await response.text();
        document.getElementById('errors').innerHTML = result;
    });
});