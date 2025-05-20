const email = document.getElementById('email');
const password = document.getElementById('password');

const errorEmail = document.getElementById('errorEmail');
const errorPassword = document.getElementById('errorPassword');

const erCorreo = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
const erPassword = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;

email.addEventListener('blur', function() {
    if (!erCorreo.test(email.value)) {
        errorEmail.style.color = "red";
        errorEmail.innerHTML = "El correo no es válido";
        email.focus();
    } else {
        errorEmail.innerHTML = "";
    }
});

password.addEventListener('blur', function() {
    if (!erPassword.test(password.value)) {
        errorPassword.style.color = "red";
        errorPassword.innerHTML = "La contraseña debe tener al menos 8 caracteres, una letra y un número";
        password.focus();
    } else {
        errorPassword.innerHTML = "";
    }
});