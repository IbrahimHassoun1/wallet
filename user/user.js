const url="http://localhost/wallet/"

console.log("test")
//check if we're logged in
window.onload = () => {
    if(!localStorage.getItem("session_id")){
    const mainPage = document.getElementById("main-page");

    mainPage.innerHTML = "";
    
    const h1 = document.createElement("h1");
    h1.textContent = "Habibi, you are not logged in";
    mainPage.style.display='flex'
    h1.style.color = "white";
    h1.style.margin='auto'

console.log("test")



    mainPage.appendChild(h1);}
};
//check if we have to hide verification
window.onload = () => {
    const session_id = localStorage.getItem("session_id");
    const apiUrl = url + "/user/api/?action=checkVerified";  

    axios.post(apiUrl, { session_id }) 
        .then(response => {
            if(response.data.is_verified==1){
                const verificationElement = document.getElementById("is_verified")
                verificationElement.classList.remove("flex")
                verificationElement.classList.add("hidden")
            };  
        })
        .catch(error => {
            console.error('Error:', error);  
        });
}
//expand the card on click
const detailCard = (event) => {

    const component= event.currentTarget
    const child=component.querySelector(".details")
    component.classList.toggle("expanded-card-component")
    child.classList.toggle("expanded-details")
    console.log(component)
};
const mountComponent=(componentId)=>{
    //hides all sections first
    const Sections = document.querySelectorAll("[class*='section']")
    Sections.forEach(section=>section.classList.remove("show"));

    const myComponent = document.getElementById(componentId)
    myComponent.classList.add("show")
    //hide to-do-list
    const list = document.getElementById("to-do-list")
    list.classList.remove('flex')
    list.classList.add('hidden')
}
const toggleNotifications=(cl)=>{
    const notifications = document.querySelectorAll(`[class*="${cl}"]`)
    console.log(notifications)
    notifications.forEach(notification=>{
        notification.classList.toggle("hidden")
        console.log(notification)
        })
    
}
window.onload(document.querySelectorAll(".section").forEach(section=>section.classList.remove("show")))



//handle sections
//profile details
document.getElementById("profile-button").addEventListener("click",function(){
    const session_id = localStorage.getItem("session_id");
    const apiUrl = url + "/user/api/?action=getUserInfo";  

    axios.post(apiUrl, { session_id }) 
        .then(response => {
            console.log(response.data) 
            const profileForm=document.getElementById("profile-form")
            //start filling inputs
            let firstName = profileForm.querySelector('[name="firstName"]')
            firstName.value=response.data.data.first_name
            let lastName = profileForm.querySelector('[name="lastName"]')
            lastName.value=response.data.data.last_name
            let phone = profileForm.querySelector('[name="phone"]')
            phone.value=response.data.data.phone
            let email = profileForm.querySelector('[name="email"]')
            email.value=response.data.data.email
            let createdAt = profileForm.querySelector('[name="createdAt"]')
            createdAt.innerHTML=response.data.data.created_at
            //add last modified in the end
            let country = profileForm.querySelector('[name="country"]')
            country.value=response.data.address.country
            let city = profileForm.querySelector('[name="city"]')
            city.value=response.data.address.city
            let street = profileForm.querySelector('[name="street"]')
            street.value=response.data.address.street
        })
        .catch(error => {
            console.error('Error:', error);  
        });
})




