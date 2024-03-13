
//Get Form
var form = document.forms["Reg"];



function Validate(){
        var username = form["username"]
        var email = form["email"]
        var password = form["password"]
        if(String(username.value).length > 6){
                if(String(email.value).endsWith("@gmail.com")){
                        ClearErrorMessage()
                }else{
                        ShowErrorMessage("The Email Format(Domain) is not supported")
                }
        }else{
                ShowErrorMessage("Username is too Short!")
        }
        return false;
}


FetchData()
function FetchData(){
        fetch("https://dummyjson.com/products").then((response)=>{
                if(response.ok){
                        return response.json()
                }else{
                        alert("No Go")
                }
                console.log(response)
        }).then((data)=>{
                
                var element = document.getElementById("dynamic")
                var productTemplate = document.getElementById("baseProduct");
                var products = data.products
                // console.log(products)
                for(let i = 0; i < products.length; i++ ){
                        var duplicate = productTemplate.cloneNode(true);
                        element.appendChild(duplicate);
                        duplicate.childNodes[1].childNodes[1].src = products[i].thumbnail
                        duplicate.childNodes[3].childNodes[1].innerText = products[i].title
                        console.log(products[i].title)
                        console.log(products[i].thumbnail)
                }
        })
}




function ShowErrorMessage(out) {
        var errmsg = document.getElementById("ErrorMessage")
        errmsg.innerText = out
}

function ClearErrorMessage(){
        document.getElementById("ErrorMessage").innerText=""
}






















