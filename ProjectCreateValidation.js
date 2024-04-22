window.onload = function() {
    let form = document.getElementById("CreateForm");
    form.addEventListener("input", function(event) {
        if (event.target === document.getElementById("ProjectStartDate") || event.target === document.getElementsById("ProjectEndDate")) {
            validateDates(form);
        }
    })
}

function validateDates(form) {
    let dateToday = new Date().getTime();
    let startDate = new Date(form.startDate.value).getTime();
    let endDate = new Date(form.endDate.value).getTime();

    const minute = 1000 * 60;
    const hour = minute * 60;
    const day = hour * 24;
    const year = day * 365; 

    if (startDate >= dateToday+day) {
        form.startDate.setCustomValidity("");
    } else {
        form.startDate.setCustomValidity("Invalid start date.");
    }

    if (endDate >= dateToday+day && endDate >= startDate+day) {
        form.endDate.setCustomValidity("");
    } else {
        form.endDate.setCustomValidity("Invalid end date.");
    }
}