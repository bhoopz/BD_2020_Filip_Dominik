const checkbox=[... document.querySelectorAll("#checkbox")]
const input= document.querySelector("#search")
const div= document.querySelector("#list")
const album=[... div.querySelectorAll("#inside")]
const priceMin= document.querySelector("#min")
const priceMax=document.querySelector("#max")
let priceMinValue = !isInt(priceMin.value)?0:parseInt(priceMin.value)
let priceMaxValue = !isInt(priceMax.value)?99999:parseInt(priceMax.value)



let inputValue = input.value.toLowerCase()
let checkboxValue = ""

checkbox.map(box=>box.addEventListener("click",()=>{
    for(let i=0; i<checkbox.length;i++){
        if(checkbox[i].value!==box.value){
            checkbox[i].checked=false
        }
    }
    if(box.checked){
        checkboxValue=box.value
    }else{
        checkboxValue=""
    }
    filter()
    
    
    
}))



input.addEventListener("keyup",()=>{   
    inputValue = input.value.toLowerCase()
    filter()
    
})
const filter=()=>{
    for(let i=0; i<album.length;i++){
        const name = album[i].dataset.name.toLowerCase()
        //const nazwa = album[i].dataset.nazwa.toLowerCase()
        const gatunek = album[i].dataset.gatunek.toLowerCase()
        const price = album[i].dataset.cena
        if(name.indexOf(inputValue)>-1 && gatunek.indexOf(checkboxValue)>-1 && price>=priceMinValue && price<=priceMaxValue){
            album[i].style.display=""
        }else{
            album[i].style.display="none"
        }
    }
}


priceMin.addEventListener("keyup",()=>{  
if(!isInt(priceMin.value)){
    priceMinValue=0
}else{
priceMinValue = parseInt(priceMin.value)
} 

    filter()

})
priceMax.addEventListener("keyup",()=>{  
    if(!isInt(priceMax.value)){
        priceMaxValue=99999
    }else{
    priceMaxValue = parseInt(priceMax.value)
    } 
    console.log(priceMaxValue===parseInt(priceMaxValue))
        filter()
    
    })
    function isInt(value) {
        return !isNaN(value) && (function(x) { return (x | 0) === x; })(parseFloat(value))
      }

            


      