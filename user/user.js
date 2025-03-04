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
    
})




