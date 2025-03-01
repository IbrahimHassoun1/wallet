//expand the card on click
const detailCard = (event) => {

    const component= event.currentTarget
    const child=component.querySelector(".details")
    component.classList.toggle("expanded-card-component")
    child.classList.toggle("expanded-details")
    console.log(component); // ✅ Output: "123"
  };
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




