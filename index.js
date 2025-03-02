document.getElementById("registerForm").addEventListener("submit", function(event) {
    event.preventDefault();  

    const formData = new FormData(this);  // Collect form data
    
    
    var appended = document.createElement("h1");

    // Clear any existing feedback message
    const existingMessage = this.querySelector("h1");
    if (existingMessage) {
        existingMessage.remove();
    }

    fetch("http://localhost/wallet/user/?action=register", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())  
    .then(data => {
        if (data.status === "success") {
            appended.textContent = "Account created successfully"; 
        } else {
            appended.textContent = data.message;  
        }
        // Append the message after the form
        this.appendChild(appended);
    })
    .catch(error => {
        console.error("Error:", error); 
        appended.textContent = "Something went wrong. Please try again later."; 
        this.appendChild(appended);
    });
});
