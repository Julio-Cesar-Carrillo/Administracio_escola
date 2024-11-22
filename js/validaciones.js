document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");

    // Selección de campos
    const dniInput = document.querySelector('input[name="dni_alu"]');
    const nombreInput = document.querySelector('input[name="nom_alu"]');
    const apellido1Input = document.querySelector('input[name="cognom1_alu"]');
    const apellido2Input = document.querySelector('input[name="cognom2_alu"]');
    const telefonoInput = document.querySelector('input[name="telf_alu"]');
    const emailInput = document.querySelector('input[name="email_alu"]');

    // Función para crear mensajes de error
    const createErrorMessage = (element, message) => {
        let errorElement = element.nextElementSibling;

        if (!errorElement || !errorElement.classList.contains("error-message")) {
            errorElement = document.createElement("div");
            errorElement.classList.add("error-message");
            element.parentNode.insertBefore(errorElement, element.nextSibling);
        }

        errorElement.textContent = message;
        errorElement.style.color = "red";
        errorElement.style.fontSize = "0.9em";
    };

    // Función para limpiar mensajes de error
    const clearErrorMessage = (element) => {
        let errorElement = element.nextElementSibling;

        if (errorElement && errorElement.classList.contains("error-message")) {
            errorElement.textContent = "";
        }
    };

    // Validar DNI: 8 números seguidos de 1 letra
    const validateDNI = (input) => {
        const value = input.value.trim();
        const regex = /^\d{8}[A-Za-z]$/;

        if (!regex.test(value)) {
            createErrorMessage(input, "El DNI debe tener 8 números seguidos de 1 letra.");
            return false;
        }

        clearErrorMessage(input);
        return true;
    };

    // Validar campos de texto (Nombre y Apellidos): mínimo 3 caracteres, sin números
    const validateText = (input, fieldName) => {
        const value = input.value.trim();
        const regex = /^[A-Za-zÀ-ÿ\s]+$/;

        if (value === "") {
            createErrorMessage(input, `El ${fieldName} no puede estar vacío.`);
            return false;
        }

        if (value.length < 3) {
            createErrorMessage(input, `El ${fieldName} debe tener al menos 3 caracteres.`);
            return false;
        }

        if (!regex.test(value)) {
            createErrorMessage(input, `El ${fieldName} no puede contener números ni caracteres especiales.`);
            return false;
        }

        clearErrorMessage(input);
        return true;
    };

    // Validar teléfono: exactamente 9 dígitos
    const validatePhone = (input) => {
        const value = input.value.trim();
        const regex = /^\d{9}$/;

        if (!regex.test(value)) {
            createErrorMessage(input, "El teléfono debe tener exactamente 9 dígitos.");
            return false;
        }

        clearErrorMessage(input);
        return true;
    };

    // Validar email: debe contener '@' y '.'
    const validateEmail = (input) => {
        const value = input.value.trim();
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!regex.test(value)) {
            createErrorMessage(input, "El correo electrónico debe contener un '@' y un '.'.");
            return false;
        }

        clearErrorMessage(input);
        return true;
    };

    // Validación al enviar el formulario
    form.addEventListener("submit", function (event) {
        let isFormValid = true;

        if (dniInput) {
            isFormValid = validateDNI(dniInput) && isFormValid;
        }
        isFormValid = validateText(nombreInput, "nombre") && isFormValid;
        isFormValid = validateText(apellido1Input, "primer apellido") && isFormValid;
        if (apellido2Input) {
            isFormValid = validateText(apellido2Input, "segundo apellido") && isFormValid;
        }
        if (telefonoInput) {
            isFormValid = validatePhone(telefonoInput) && isFormValid;
        }
        if (emailInput) {
            isFormValid = validateEmail(emailInput) && isFormValid;
        }

        if (!isFormValid) {
            event.preventDefault(); // Evita el envío si hay errores
        }
    });

    // Validación en tiempo real
    if (dniInput) {
        dniInput.addEventListener("input", () => validateDNI(dniInput));
    }
    nombreInput.addEventListener("input", () => validateText(nombreInput, "nombre"));
    apellido1Input.addEventListener("input", () => validateText(apellido1Input, "primer apellido"));
    if (apellido2Input) {
        apellido2Input.addEventListener("input", () => validateText(apellido2Input, "segundo apellido"));
    }
    if (telefonoInput) {
        telefonoInput.addEventListener("input", () => validatePhone(telefonoInput));
    }
    if (emailInput) {
        emailInput.addEventListener("input", () => validateEmail(emailInput));
    }
});
