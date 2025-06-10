const form = document.getElementById('contactForm');

form.addEventListener('submit', function(event) {
    event.preventDefault();

    const email = form.email.value.trim();
    const telefono = form.telephone.value.trim();
    const errorDiv = document.getElementById('response');
    const telefonoRegex = /^\d{3}-\d{3}-\d{4}$/;

    // Validación de email
    if (!validateEmail(email)) {
        errorDiv.innerHTML = "Invalid email format";
        return;
    }

    // Validación de teléfono
    if (!telefonoRegex.test(telefono)) {
        errorDiv.innerHTML = 
            "Formato de Teléfono inválido. Debe ser por ejemplo: 123-456-7890.";
        return;
    }

    errorDiv.innerHTML = "";

    const formData = new FormData(form);

    fetch(form.action, {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        errorDiv.innerHTML = data;
    })
    .catch(error => {
        console.error('Error:', error);
    });
});

function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}