//creating charts
console.log("test")
//left-up
document.getElementById("overview-button").addEventListener("click",()=>{
    const myCanva = document.getElementById("left-upper-chart")
    new Chart(myCanva, {
        type: 'pie', 
        data: {
            labels: ['Red', 'Blue', 'Yellow'], 
            datasets: [{
                data: [30, 50, 20], 
                backgroundColor: ['red', 'blue', 'yellow'] 
            }]
        }
    })
})
const mountComponent=(componentId)=>{
    //hides all sections first
    const toggled=document.getElementById(componentId).classList.contains("showAdmin")
    const Sections = document.querySelectorAll("[class*='section']")
    Sections.forEach(section=>section.classList.remove("showAdmin"));

    const myComponent = document.getElementById(componentId)
    toggled?
    myComponent.classList.remove("showAdmin"):
    myComponent.classList.add("showAdmin")
    
}
const collapseExpand = (event)=>{
    const element = event.currentTarget
    element.classList.toggle("collapse")
}
window.onload(document.querySelectorAll(".section").forEach(section=>{
    section.classList.remove("show")
    section.classList.remove("showAdmin")
}))




