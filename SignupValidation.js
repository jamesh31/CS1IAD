// The methods in this file check if all signup form items are not empty, and if the emails are equal.

window.onload = function() {

    const form = document.getElementById("SignupForm")

    form.addEventListener("input", function(event) {
        if (event.target === form.Username || event.target === form.Password) {
            isFormEmpty(event.target);
        } else if (event.target === form.Email || event.target === form.ConfirmEmail) {
            validateEmails(form);
        }
    })

    form.submitButton.onclick = function() {
        if (form.checkValidity()) {
            form.submit();
        } else {
            console.log(form.reportValidity())
        }
    }
}

function isFormEmpty(checkForm) {
    if (checkForm.value) {
        checkForm.setCustomValidity("")
        return true;
    } else {
        checkForm.setCustomValidity("Fill in this field.")
        return false;
    }
}

function validateEmails(form) {
    if (isFormEmpty(form.Email) && isFormEmpty(form.ConfirmEmail)) {
        if (form.Email.value != form.ConfirmEmail.value) {
            form.ConfirmEmail.setCustomValidity("The inputted emails do not match.")
        } 
    } 
}

function validatePassword() {
    // Put the password definition restrictions in here
    print("TODO");
}