var map=new Map();
document.querySelector(".username input").addEventListener("keyup", checkUsername);
map.set("username",false);
map.set("name",false);
map.set("surname",false);
map.set("email",false);
map.set("password",false);
map.set("confirm",false);

function jsonCheckUsername(json) {

    const user_box = document.querySelector(".username");
    const check = user_box.querySelectorAll("img");

    if (!json.exists) {
        user_box.querySelector('span').textContent = "Username valido";
        user_box.querySelector("span").classList.remove("error-text");
        user_box.querySelector("span").classList.add('valid-text');
        check[0].classList.remove("hidden");
        check[1].classList.add("hidden");
    } else {
        user_box.querySelector('span').textContent ="Nome utente già utilizzato";
        map.set("username",false);
    }
    user_box.querySelector(".error").classList.remove('hidden');
}


function fetchResponse(response) {
    if (!response.ok){
        return null;
    }

    return response.json();
}


function checkUsername(event){
    const input = event.currentTarget
    const user_box = document.querySelector(".username");
    
    user_box.querySelector("span").classList.remove('valid-text');
    user_box.querySelector("span").classList.add('error-text');
    
    const check = user_box.querySelectorAll("img");
    check[0].classList.add("hidden");
    check[1].classList.remove("hidden");
    
    map.set("username",true);
    
    if(input.value.length < 4){
        user_box.querySelector('span').textContent = "Il nome deve avere minimo 4 caratteri";
        user_box.querySelector(".error").classList.remove('hidden');
        map.set("username",false);
    }else if(!/^[a-zA-Z0-9_]{1,15}$/.test(input.value)) {
        user_box.querySelector('span').textContent = "Sono ammesse lettere, numeri e underscore. Max. 15";
        user_box.querySelector(".error").classList.remove('hidden');
        map.set("username",false);

    }else {
        fetch("./search_username.php?q="+encodeURIComponent(input.value)).then(fetchResponse).then(jsonCheckUsername);
    } 
}

//-------------------------------------------------------------------------------------------------------------------------------
document.querySelector(".name input").addEventListener("keyup", checkName);


function checkName(event){
    const input = event.currentTarget
    const user_box = document.querySelector(".name");
    user_box.querySelector(".error").classList.add('hidden');
    map.set("name",true);
    
    if(input.value===""){
        user_box.querySelector('span').textContent = "Parametro mancante";
        user_box.querySelector(".error").classList.remove('hidden');
        map.set("name",false);
    }else if(!/^[a-zA-Z0-9_]{1,15}$/.test(input.value)) {
        user_box.querySelector('span').textContent = "Sono ammesse lettere, numeri e underscore. Max. 15";
        user_box.querySelector(".error").classList.remove('hidden');
        map.set("name",false);
    }
}

//---------------------------------------------------------------------------------------------------------------------------------
document.querySelector(".surname input").addEventListener("keyup", checkSurname);

function checkSurname(event){
    const input = event.currentTarget
    const user_box = document.querySelector(".surname");
    user_box.querySelector(".error").classList.add('hidden');
    map.set("surname",true);
    
    if(input.value===""){
        user_box.querySelector('span').textContent = "Parametro mancante";
        user_box.querySelector(".error").classList.remove('hidden');
        map.set("surname",false);
    }else if(!/^[a-zA-Z0-9_]{1,15}$/.test(input.value)) {
        user_box.querySelector('span').textContent = "Sono ammesse lettere, numeri e underscore. Max. 15";
        user_box.querySelector(".error").classList.remove('hidden');
        map.set("surname",false);
    }
}

//------------------------------------------------------------------------------------------------------------------------------
document.querySelector(".email input").addEventListener("keyup", checkEmail);

function jsonSearchEmail(json){
    
    const user_box = document.querySelector(".email");
    const check = user_box.querySelectorAll("img");
    
    if (!json.exists) {
        user_box.querySelector('span').textContent = "E-mail valida";
        user_box.querySelector("span").classList.remove("error-text");
        user_box.querySelector("span").classList.add('valid-text');
        check[0].classList.remove("hidden");
        check[1].classList.add("hidden");
    } else {
        user_box.querySelector('span').textContent ="E-mail già presente nel database";
        map.set("email",false);
    }
    user_box.querySelector(".error").classList.remove('hidden');
}


function emailIsValid(email) {
    var regex_email_valida = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return regex_email_valida.test(email);
}


function checkEmail(event){
    const input = event.currentTarget;
    const mail_box = document.querySelector(".email");
    mail_box.querySelector(".error").classList.add("hidden");
    map.set("email",true);
    
    if(emailIsValid(input.value)){
        fetch("./search_email.php?q="+encodeURIComponent(input.value)).then(fetchResponse).then(jsonSearchEmail);
    }else{
        mail_box.querySelector("span").textContent = "E-mail errata"
        mail_box.querySelector(".error").classList.remove("hidden");
        map.set("email",false);
    }
}

//----------------------------------------------------------------------------------------------------------------------------------
document.querySelector(".password input").addEventListener("keyup", checkPassword);

function checkPassword(event){
    const input = event.currentTarget
    const user_box = document.querySelector(".password");
    user_box.querySelector(".error").classList.add('hidden');
    map.set("password",true);
    
    if(input.value.length < 8){
        user_box.querySelector('span').textContent = "La password deve contenere almeno 8 caratteri";
        user_box.querySelector(".error").classList.remove('hidden');
        map.set("password",false);
    }else if(!/^[a-zA-Z0-9_]{1,15}$/.test(input.value)) {
        user_box.querySelector('span').textContent = "Sono ammesse lettere, numeri e underscore. Max. 15";
        user_box.querySelector(".error").classList.remove('hidden');
        map.set("password",false);
    }
}

//------------------------------------------------------------------------------------------------------------------------------------
document.querySelector(".confirm_password input").addEventListener("keyup", checkConfirm);

function checkConfirm(event){
    const input = event.currentTarget
    const conf_box = document.querySelector(".confirm_password");
    const pass_input = document.querySelector(".password input");
    conf_box.querySelector(".error").classList.add('hidden');
    map.set("confirm",true);

    
    if(input.value !== pass_input.value){
        conf_box.querySelector('.error span').textContent = "Le password sono diverse tra loro";
        conf_box.querySelector(".error").classList.remove('hidden');
        map.set("confirm",false);
    }
}

//------------------------------------------------------------------------------------------------------------------
document.querySelector("form").addEventListener("submit", checkForm);

function checkForm(event){
    document.querySelector(".error-form").classList.add("hidden");
    if(!(map.get("username") && map.get("name") && map.get("surname") && map.get("email") &&
    map.get("password") && map.get("confirm"))){
        event.preventDefault();
        document.querySelector(".error-form").classList.remove("hidden");
    }
}
