const url="http://localhost/wallet/"

//creating charts
console.log("test")
//left-up
document.getElementById("overview-button").addEventListener("click",()=>{
    const colors=['#10a4ca','#feffff',"#ff7f11","#ff6b6b","Purple"]
    const data=[]
    const labels=[]
    //get stats
    
    //drawing upper-left
    axios.get(url+"admin/api/?action=getCards")
    .then(response=>{
        
        response.data.data.forEach(row=>{
            data.push(row.total)
            labels.push(row.card_type)
           
        })
        
        const myCanva = document.getElementById("left-upper-chart")
        new Chart(myCanva, {
            type: 'pie', 
            data: {
                labels: [...labels], 
                datasets: [{
                    data: [...data], 
                    backgroundColor: colors
                }]
            }
        })
    })
    
    //drawing upper-right
    
    

    
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




