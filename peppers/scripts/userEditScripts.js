document.getElementById('logoutLink').addEventListener('click', function () {
    localStorage.removeItem('rememberedUsername');
    localStorage.removeItem('rememberedPassword');
});

document.getElementById('editField').addEventListener('change', function() {
    var field = this.value;
    if (field === 'userName' || field === 'passwd' || field === 'email') {
        document.getElementById('currentPasswordField').style.display = 'block';
    } else {
        document.getElementById('currentPasswordField').style.display = 'none';
    }
});

document.getElementById('editField').addEventListener('change', function () {
    var field = this.value;
    var newValueLabel = document.querySelector("label[for='newValue']");
    var currentPasswordField = document.getElementById('currentPasswordField');

    switch (field) {
        case 'userName':
            newValueLabel.textContent = 'Nowa nazwa użytkownika:';
            currentPasswordField.style.display = 'block';
            newValue.type="text";
            break;
        case 'passwd':
            newValueLabel.textContent = 'Nowe hasło:';
            currentPasswordField.style.display = 'block';
            newValue.type="password";
            break;
        case 'email':
            newValueLabel.textContent = 'Nowy adres email:';
            currentPasswordField.style.display = 'block';
            newValue.type="email";
            break;
        case 'fullName':
            newValueLabel.textContent = 'Nowe imię i nazwisko:';
            currentPasswordField.style.display = 'none';
            newValue.type="text";
            break;
        default:
            newValueLabel.textContent = 'Nowa wartość:';
            currentPasswordField.style.display = 'none';
            newValue.type="text";
    }
});


document.querySelector("form").addEventListener("submit", function (e) {
var field = document.getElementById("editField").value;
var newValue = document.getElementById("newValue").value;
var errorMessage = "";

switch (field) {
    case "userName":
        if (!/^[0-9A-Za-ząęłńśćźżó_-]{2,25}$/.test(newValue)) {
            errorMessage = "Nazwa użytkownika musi mieć od 2 do 25 znaków i zawierać tylko litery, cyfry, myślniki i podkreślenia.";
        }
        break;
    case "passwd":
        if (!/.{5,}/.test(newValue)) {
            errorMessage = "Hasło musi mieć co najmniej 5 znaków.";
        }
        break;
    case "email":
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(newValue)) {
            errorMessage = "Podaj prawidłowy adres e-mail.";
        }
        break;
    case "fullName":
        if (!/^[A-Za-ząęłńśćźżó ]{2,50}$/.test(newValue)) {
            errorMessage = "Imię i nazwisko musi mieć od 2 do 50 znaków i zawierać tylko litery oraz spacje.";
        }
        break;
    default:
        errorMessage = "Nieprawidłowe pole do edycji.";
}

if (errorMessage !== "") {
    e.preventDefault(); //zatrzymanie wysyłania formularza
    alert(errorMessage); //wyświetlenie komunikatu o błędzie
}
});


document.getElementById('editField').addEventListener('change', function () {
var field = this.value;
var newValueLabel = document.querySelector("label[for='newValue']");
var currentPasswordField = document.getElementById('currentPasswordField');
var successMessage = document.querySelector('.custom-alert-success');
var errorMessage = document.querySelector('.custom-alert-error');

//ukryj komunikaty przy zmianie edytowanej danej
if (successMessage) {
    successMessage.style.display = 'none';
}
if (errorMessage) {
    errorMessage.style.display = 'none';
}

});