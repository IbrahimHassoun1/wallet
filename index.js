document.getElementById("registerForm").addEventListener("submit", function(event) {
    event.preventDefault();  

    const formData = new FormData(this);  

    // Create the message element
    var appended = document.createElement("h4");
    
    // Remove any existing message
    const existingMessage = this.querySelector("h4");
    if (existingMessage) {
        existingMessage.remove();  
    }

    // Set the "Please wait" message
    appended.textContent = "Please wait...";
    appended.style.textAlign = 'center';
    appended.style.fontWeight = '100';
    this.appendChild(appended);  // Append it to the form

    // Send the form data via fetch
    fetch("http://localhost/wallet/user/?action=register", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())  
    .then(data => {
        // Remove the "Please wait" message and set the response message
        appended.remove();

        const newMessage = document.createElement("h4");
        newMessage.style.textAlign = 'center';
        newMessage.style.fontWeight = '100';

        if (data.status === "success") {
            newMessage.textContent = "Account created successfully"; 
            newMessage.classList.add('txt-green');  
        } else {
            newMessage.textContent = data.message;  
            newMessage.classList.add('txt-red');  
        }

        this.appendChild(newMessage);  // Append the new message after the form
    })
    .catch(error => {
        console.error("Error:", error);  
        // If there's an error, remove the "Please wait" message and display the error
        appended.remove();

        const errorMessage = document.createElement("h4");
        errorMessage.textContent = "Something went wrong. Please try again later.";  
        errorMessage.classList.add('txt-red'); 
        errorMessage.style.textAlign = 'center';
        errorMessage.style.fontWeight = '100';
        this.appendChild(errorMessage);  // Append the error message
    });
});


document.getElementById("loginForm").addEventListener("submit", (event) => {
    event.preventDefault(); 

    const form = event.target;  
    const identifier = new FormData(form).get("identifier");  

    const appended = document.createElement('h4');
    const existingMessage = form.querySelector("h4");

    // Remove existing message if any
    if (existingMessage) {
        existingMessage.remove();  
    }

    // Reset appended message styles
    appended.classList = [];
    appended.style.textAlign = 'center';
    appended.style.fontWeight = '100';
    appended.classList.add('text-red');

    function isEmail(input) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(input);
    }

    function isPhone(input) {
        return /^\d{8,15}$/.test(input); // Adjust the phone regex as needed
    }

    // Validate login input
    if (isEmail(identifier)) {
        appended.textContent = "Logging in with email...";
        
    } else if (isPhone(identifier)) {
        appended.textContent = "Logging in with phone...";
        
    } else {
        appended.textContent = "The input is neither an email nor a phone number";
    }

    form.appendChild(appended);  // Append message after the form
});

const mountComponent=(componentId)=>{
    //hides all sections first
    const Sections = document.querySelectorAll(".section")
    Sections.forEach(section=>section.classList.remove("showAdmin"));

    const myComponent = document.getElementById(componentId)
    myComponent.classList.add("showAdmin")
}

