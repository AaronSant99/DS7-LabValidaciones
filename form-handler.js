document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contactForm');
    form.addEventListener('submit', async function(event) {
        event.preventDefault();

        let errorMsgList = [];

        // Validación cliente
        const nombre = form.name.value.trim();
        if (nombre === "" || !/^[a-zA-Z ]+$/.test(nombre)) {
            errorMsgList.push("Solo letras y espacios en blanco permitidos en el nombre.");
        }

        const email = form.email.value.trim();
        if (email === "" || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            errorMsgList.push("Formato de Correo Inválido.");
        }

        const telefono = form.telephone.value.trim();
        const telefonoRegex = /^\d{3}-\d{3}-\d{4}$/;
        if (!telefonoRegex.test(telefono)) {
            errorMsgList.push("Formato de Teléfono inválido. Ejemplo de Formato Valido: 123-456-7890.");
        }

        const captcha = form.captcha.value.trim();
        if (captcha === "") {
            errorMsgList.push("El código CAPTCHA es obligatorio.");
        }

        if (errorMsgList.length > 0) {
            document.getElementById('errors').innerHTML = errorMsgList.join('<br>');
            return;
        }

        // Si no hay errores en cliente, envía al backend
        const formData = new FormData(form);
        try {
            const response = await fetch(form.action, {
                method: form.method,
                body: formData,
            });
            const result = await response.json();

            if (!result.success) {
                // Si errors es array, únelos con salto de línea
                if (Array.isArray(result.errors)) {
                    document.getElementById('errors').innerHTML = result.errors.join('<br>');
                } else {
                    document.getElementById('errors').innerHTML = result.errors || "Ocurrió un error desconocido.";
                }
            } else {
                document.getElementById('errors').innerHTML = "";
                // Aquí puedes mostrar un mensaje de éxito o limpiar el formulario si lo deseas.
                // Por ejemplo:
                // form.reset();
                // document.getElementById('response').innerText = "¡Registro exitoso!";
            }
        } catch (err) {
            document.getElementById('errors').innerHTML = "Error de conexión con el servidor.";
        }
    });
});