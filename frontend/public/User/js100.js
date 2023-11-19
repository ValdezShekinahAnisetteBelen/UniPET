function validateDate() {
    var selectedDate = new Date(document.getElementById("appointment_date").value);
    var dayOfWeek = selectedDate.getDay(); // 0 = Sunday, 1 = Monday, ..., 6 = Saturday

    var messageElement = document.getElementById("message");

    if (dayOfWeek !== 4 && dayOfWeek !== 5 && dayOfWeek !== 0) { // Thursday, Friday, Sunday
        messageElement.innerHTML = "Please choose another day. Appointments are available on Thursday, Friday, and Sunday only.";
    } else {
        messageElement.innerHTML = "";
    }
}