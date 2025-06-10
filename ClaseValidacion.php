<?PHP
//https://mailtrap.io/blog/php-form-validation/#How-to-validate-a-form-in-PHP-using-script
class FormValidator {
    private $data;
    private $requiredFields = [];



    public function __construct($postData) {
        $this->data = $postData;
    }
    public function setRequiredFields(array $fields) {
    $this->requiredFields = $fields;
    }
    public function validate() {
        // Common validation rules
        $this->validateRequiredFields();
        $this->validarFormatoCorreo();
        $this->validarFormatoTelefono();
        // Add more validation methods as needed
    }

    private function validateRequiredFields() {
        // Check if required fields are present
        foreach ($this->requiredFields as $field) {
            if (empty($this->data[$field])) {
                throw new Exception("{$field} is required.");
            }
        }
    }

    private function validarFormatoCorreo() {
        // Check if email field is in a valid format
        if (!filter_var($this->data['correo'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Formato de Correo Invalido.");
        }
    }

    private function validarFormatoTelefono() {
    // Valida el formato 123-456-7890
        if (!preg_match('/^\d{3}-\d{3}-\d{4}$/', $this->data['telefono'])) {
            throw new Exception("Formato de Teléfono inválido. Debe ser por ejemplo: 123-456-7890.");
        }
    }

}


?>