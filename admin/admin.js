const url="http://localhost/wallet/"

window.addEventListener("load",()=>{
    const key = localStorage.getItem("session_id")
   
    if(!localStorage.getItem("session_id")){
        const mainPage = document.getElementById("admin-page");
    
        mainPage.innerHTML = "";
        
        const h1 = document.createElement("h1");
        h1.textContent = " you are not logged in";
        mainPage.style.display='flex'
        h1.style.color = "white";
        h1.style.margin='auto'
    
        console.log(localStorage.getItem("session_id"))
    
        mainPage.appendChild(h1);}
})

//creating charts
console.log("test")
//left-up
document.getElementById("overview-button").addEventListener("click",()=>{
    
    
    //get stats
    
    //drawing upper-left
    axios.get(url+"admin/api/?action=getCards")
    .then(response=>{
        const colors=['#10a4ca','#feffff',"#ff7f11","#ff6b6b","Purple"]
        const data=[]
        const labels=[]
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
    axios.get(url+"admin/api/?action=getLocations")
    .then(response=>{
        const colors=['#10a4ca','#feffff',"#ff7f11","#ff6b6b","Purple"]
        const countries=[]
        
        const data=[]
        const labels=[]
        response.data.data.forEach(row=>{
            data.push(row.total)
            countries.push(row.country)
            
        })
        console.log(data,countries)
        const myCanva = document.getElementById("right-upper-chart")

        //charts made by chatgpt
        new Chart(myCanva, {
        type: 'bar', 
        data: {
            labels: countries, 
            datasets: [{
                label: "Users",
                data: data, 
                backgroundColor: colors, 
                
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    labels: {
                        color: '#feffff'
                    }
                }
            },
            scales: {
                x: {
                    ticks: {
                        color: '#feffff' 
                    }
                },
                y: {
                    ticks: {
                        color: '#feffff' 
                    }
                }
            }
        }
    });
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




