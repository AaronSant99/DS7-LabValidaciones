document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contactForm');
    form.addEventListener('submit', async function(event) {
        event.preventDefault();
        const formData = new FormData(form);
        const response = await fetch(form.action, {
            method: form.method,
            body: formData,
        });
        const result = await response.text();
        // Busca el div#errors en la respuesta, o simplemente reemplázalo
        document.getElementById('errors').innerHTML = result;
    });
});