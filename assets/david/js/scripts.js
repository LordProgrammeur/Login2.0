// scripts.js

// Función para validar las reglas de la contraseña
function validatePassword() {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm-password').value;

    // Reglas de validación
    const rules = {
        length: /^(?=.{8,})/,             // Mínimo 8 caracteres
        uppercase: /^(?=.*[A-Z])/,        // Al menos una letra mayúscula
        special: /^(?=.*[@$!%*?&])/,      // Al menos un carácter especial
    };

    // Validar longitud
    document.getElementById('length').className = rules.length.test(password) ? 'valid' : 'invalid';

    // Validar mayúscula
    document.getElementById('uppercase').className = rules.uppercase.test(password) ? 'valid' : 'invalid';

    // Validar carácter especial
    document.getElementById('special').className = rules.special.test(password) ? 'valid' : 'invalid';

    // Validar confirmación de la contraseña
    document.getElementById('match').className = (password === confirmPassword && password !== '') ? 'valid' : 'invalid';
}

// Agregar event listeners a los campos de contraseña
document.getElementById('password').addEventListener('input', validatePassword);
document.getElementById('confirm-password').addEventListener('input', validatePassword);


//Tooltip condiciones contraseña

document.addEventListener('DOMContentLoaded', function () {
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirm-password');
    const passwordRules = document.getElementById('password-rules');
    const confirmPasswordRules = document.getElementById('confirm-password-rules');
    const lengthRule = document.getElementById('length');
    const uppercaseRule = document.getElementById('uppercase');
    const specialRule = document.getElementById('special');
    const matchRule = document.getElementById('match');
    const lengthConfirmRule = document.getElementById('length-confirm');
    const uppercaseConfirmRule = document.getElementById('uppercase-confirm');
    const specialConfirmRule = document.getElementById('special-confirm');
    const matchConfirmRule = document.getElementById('match-confirm');

    function updatePasswordRules() {
        const passwordValue = passwordInput.value;
        const confirmPasswordValue = confirmPasswordInput.value;
        let valid = true;

        // Length rule
        if (passwordValue.length >= 8) {
            lengthRule.classList.remove('invalid');
            lengthRule.classList.add('valid');
        } else {
            lengthRule.classList.remove('valid');
            lengthRule.classList.add('invalid');
            valid = false;
        }

        // Uppercase rule
        if (/[A-Z]/.test(passwordValue)) {
            uppercaseRule.classList.remove('invalid');
            uppercaseRule.classList.add('valid');
        } else {
            uppercaseRule.classList.remove('valid');
            uppercaseRule.classList.add('invalid');
            valid = false;
        }

        // Special character rule
        if (/[@$!%*?&]/.test(passwordValue)) {
            specialRule.classList.remove('invalid');
            specialRule.classList.add('valid');
        } else {
            specialRule.classList.remove('valid');
            specialRule.classList.add('invalid');
            valid = false;
        }

        // Match rule
        if (passwordValue && confirmPasswordValue) {
            if (passwordValue === confirmPasswordValue) {
                matchRule.classList.remove('invalid');
                matchRule.classList.add('valid');
            } else {
                matchRule.classList.remove('valid');
                matchRule.classList.add('invalid');
                valid = false;
            }
        } else {
            matchRule.classList.remove('valid');
            matchRule.classList.add('invalid');
        }

        // Update rules for confirm password
        if (passwordValue.length >= 8) {
            lengthConfirmRule.classList.remove('invalid');
            lengthConfirmRule.classList.add('valid');
        } else {
            lengthConfirmRule.classList.remove('valid');
            lengthConfirmRule.classList.add('invalid');
        }

        if (/[A-Z]/.test(passwordValue)) {
            uppercaseConfirmRule.classList.remove('invalid');
            uppercaseConfirmRule.classList.add('valid');
        } else {
            uppercaseConfirmRule.classList.remove('valid');
            uppercaseConfirmRule.classList.add('invalid');
        }

        if (/[@$!%*?&]/.test(passwordValue)) {
            specialConfirmRule.classList.remove('invalid');
            specialConfirmRule.classList.add('valid');
        } else {
            specialConfirmRule.classList.remove('valid');
            specialConfirmRule.classList.add('invalid');
        }
    }

    // Show the rules box when user is typing in password field
    passwordInput.addEventListener('focus', function () {
        passwordRules.style.display = 'block';
    });

    confirmPasswordInput.addEventListener('focus', function () {
        confirmPasswordRules.style.display = 'block';
    });

    passwordInput.addEventListener('blur', function () {
        passwordRules.style.display = 'none';
    });

    confirmPasswordInput.addEventListener('blur', function () {
        confirmPasswordRules.style.display = 'none';
    });

    // Update rules box while user types
    passwordInput.addEventListener('input', updatePasswordRules);
    confirmPasswordInput.addEventListener('input', updatePasswordRules);
});
