function sendEmail(e) {
    if (e) e.preventDefault();

    const name = document.querySelector("#name").value.trim();
    const email = document.querySelector("#email").value.trim();
    const number = document.querySelector("#number").value.trim();
    const date = document.querySelector("#date").value.trim();
    const location = document.querySelector("#location").value.trim();

    if (!name || !email || !number || !date || !location) {
        Swal.fire({
            title: "Validation Error",
            text: "Please fill in all the required fields.",
            icon: "warning",
            confirmButtonText: "OK"
        });
        return;
    }

    const templateParams = { name, email, number, date, location };

    const btn = document.querySelector(".theme-btn-s3");
    const originalText = btn.textContent;
    btn.textContent = "Sending...";

    emailjs
        .send("oaykiryagwzaxzov", "template_tjlg90j", templateParams)
        .then(() => {
            btn.textContent = originalText;
            Swal.fire({
                title: "Mail Sent!",
                text: "Your inquiry has been sent successfully.",
                icon: "success",
                confirmButtonText: "OK"
            });
            document.querySelector(".contact-validation-active").reset();
        })
        .catch((error) => {
            btn.textContent = originalText;
            console.error('EmailJS Error:', error);
            Swal.fire({
                title: "Error!",
                text: "Failed to send mail. Please try again later.",
                icon: "error",
                confirmButtonText: "OK"
            });
        });
}