document.getElementById('contactForm').addEventListener('submit', function(e) {
    let email = document.querySelector('input[name="email"]').value;
    if (!email.includes("@")) {
        alert("Please enter a valid email address.");
        e.preventDefault();
    }
});