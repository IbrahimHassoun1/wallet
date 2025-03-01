const mountComponent=(componentId)=>{
    //hides all sections first
    const Sections = document.querySelectorAll(".section")
    Sections.forEach(section=>section.classList.remove("show"));

    const myComponent = document.getElementById(componentId)
    myComponent.classList.add("show")
}
const toggleNotifications=()=>{
    const notifications = document.getElementById("notifications")
    notifications.classList.toggle("section")
}
window.onload(document.querySelectorAll(".section").forEach(section=>section.classList.remove("show")))