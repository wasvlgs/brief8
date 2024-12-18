


function slideHome(){
    let getMenu = document.getElementById("menu");
    let openMenu = document.getElementById("openMenu");
    let closeMenu = document.getElementById("closeMenu");

    openMenu.onclick = ()=>{
        openMenu.classList.remove("max-sm:block");
        closeMenu.classList.add("max-sm:block");
        getMenu.style.width = "100%";
    }
    closeMenu.onclick = ()=>{
        closeMenu.classList.remove("max-sm:block");
        openMenu.classList.add("max-sm:block");
        getMenu.style.width = "0%";
    }
}






const name = /^[a-zA-Z\s]+$/;
const address = /^[a-zA-Z0-9\s,.'-]{3,}$/;
const phone = /^\(?\d{3}\)?[\s\-]?\d{3}[\s\-]?\d{4}$/;
const email = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
const password = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;

const dateRegex = /^\d{4}-\d{2}-\d{2}$/;
const timeRegex = /^([01]\d|2[0-3]):([0-5]\d)$/;
const peopleRegex = /^[1-9][0-9]*$/;

const titleRegex = /^[A-Za-z0-9\s]+$/;
const priceRegex = /^[1-9]\d*(\.\d+)?$/;
const imageTypeRegex = /^image\/(jpeg|png|gif)$/;



function checkSignUp(){
    document.querySelector("#formSignUp").addEventListener("submit",(event)=>{
        const formElements = event.target.elements;

        let getFName = formElements['firstname'];
        let getLName = formElements['lastname'];
        let getAddress = formElements['address'];
        let getPhone = formElements['phone'];
        let getEmail = formElements['email'];
        let getPassword = formElements['password'];
        let getConfirmpassword = formElements['confirmpassword'];

        
        getFName.style.border = "1px solid #d1d5db";
        getLName.style.border = "1px solid #d1d5db";
        getAddress.style.border = "1px solid #d1d5db";
        getPhone.style.border = "1px solid #d1d5db";
        getEmail.style.border = "1px solid #d1d5db";
        getPassword.style.border = "1px solid #d1d5db";
        getConfirmpassword.style.border = "1px solid #d1d5db";

        if(!name.test(getFName.value)){
            event.preventDefault();
            getFName.style.border = "2px solid red";
        }else if(!name.test(getLName.value)){
            event.preventDefault();
            getLName.style.border = "2px solid red";
        }else if(!address.test(getAddress.value)){
            event.preventDefault();
            getAddress.style.border = "2px solid red";
        }else if(!phone.test(getPhone.value)){
            event.preventDefault();
            getPhone.style.border = "2px solid red";
        }else if(!email.test(getEmail.value)){
            event.preventDefault();
            getEmail.style.border = "2px solid red";
        }else if(!password.test(getPassword.value)){
            event.preventDefault();
            getPassword.style.border = "2px solid red";
        }else if(!password.test(getConfirmpassword.value)){
            event.preventDefault();
            getConfirmpassword.style.border = "2px solid red";
        }
        else if(getConfirmpassword.value != getPassword.value){
            event.preventDefault();
            getPassword.style.border = "2px solid red";
            getConfirmpassword.style.border = "2px solid red";
        }
    })
}

function checkSignIn(){
    document.querySelector("#formSignIn").addEventListener("submit",(event)=>{
        const formElements = event.target.elements;


        let getEmail = formElements['email'];
        let getPassword = formElements['password'];


        getEmail.style.border = "1px solid #d1d5db";
        getPassword.style.border = "1px solid #d1d5db";

        if(!email.test(getEmail.value)){
            event.preventDefault();
            getEmail.style.border = "2px solid red";
        }else if(!password.test(getPassword.value)){
            event.preventDefault();
            getPassword.style.border = "2px solid red";
        }
    })
}


function checkReserveUser(){
    document.querySelector("#formReserve").addEventListener("submit",(event)=>{
        const formElements = event.target.elements;


        let getDate = formElements['date'];
        let getTime = formElements['time'];
        let getPeople = formElements['people'];


        getDate.style.border = "1px solid #d1d5db";
        getTime.style.border = "1px solid #d1d5db";
        getPeople.style.border = "1px solid #d1d5db";

        if(!dateRegex.test(getDate.value)){
            event.preventDefault();
            getDate.style.border = "2px solid red";
        }else if(!timeRegex.test(getTime.value)){
            event.preventDefault();
            getTime.style.border = "2px solid red";
        }else if(!peopleRegex.test(getPeople.value)){
            event.preventDefault();
            getPeople.style.border = "2px solid red";
        }
    })
}

function checkMenu(){
    document.querySelector("#formMenu").addEventListener("submit",(event)=>{
        const formElements = event.target.elements;


        let getMenutitle = formElements['menutitle'];
        let getMenuprix = formElements['menuprix'];
        let getMenuimage = formElements['menuimage'];


        getMenutitle.style.border = "1px solid #d1d5db";
        getMenuprix.style.border = "1px solid #d1d5db";
        getMenuimage.style.border = "1px solid #d1d5db";

        if(!titleRegex.test(getMenutitle.value) || getMenutitle.value.trim() == ""){
            event.preventDefault();
            getMenutitle.style.border = "2px solid red";
        }else if(!priceRegex.test(getMenuprix.value)){
            event.preventDefault();
            getMenuprix.style.border = "2px solid red";
        }else if(!imageTypeRegex.test(getMenuimage.value)){
            event.preventDefault();
            getMenuimage.style.border = "2px solid red";
        }
    })
}

function checkPlat(){
    document.querySelector("#formPlat").addEventListener("submit",(event)=>{
        const formElements = event.target.elements;


        let getMenuselect = formElements['menuselect'];
        let getDishname = formElements['dishname'];
        let getMenudescription = formElements['menudescription'];
        let getDishimage = formElements['dishimage'];


        getMenuselect.style.border = "1px solid #d1d5db";
        getDishname.style.border = "1px solid #d1d5db";
        getMenudescription.style.border = "1px solid #d1d5db";
        getDishimage.style.border = "1px solid #d1d5db";

        if(getMenuselect.value.trim() == ""){
            event.preventDefault();
            getMenuselect.style.border = "2px solid red";
        }else if(!titleRegex.test(getDishname.value) || getDishname.value.trim() == ""){
            event.preventDefault();
            getDishname.style.border = "2px solid red";
        }else if(getMenudescription.value.trim() == ""){
            event.preventDefault();
            getMenudescription.style.border = "2px solid red";
        }else if(!imageTypeRegex.test(getDishimage.value)){
            event.preventDefault();
            getDishimage.style.border = "2px solid red";
        }
    })
}